<?php
/**
* Class Compress
* Kelas yang digunakan untuk meng-compress dan men-decompress file 
*/
class Compress 
{
	private $pathFile; 		//lokasi file yang akan di-compress atau di-decompress
	private $filename; 		//nama file yang akan di-compress atau di-decompress
	private $textInside; 	//isi text yang ada di dalam file
	private $firstBit;		//bit awal dari text yang baru dibuka
	private $finalBit;		//bit akhir dari text yang sudah di-compress atau di-decompress
	private $timeProccess;	//lama waktu yang digunakan selama proses dalam detik
	private $bitRate;		//BitRate
		/**
	* Fungsi construct dipanggil ketika mendeklarasikan objek baru dari class
	* $file adalah file yang akan diproses
	**/
	function __construct($file){		
		$this->pathFile = $file;										// inisialisasi pathFile
		$this->filename = pathinfo($this->pathFile)['filename'];		//mengambil namafile dari pathFile
		$this->getTextInside();											//menjalankan fungsi getTextInside
	}

	
	/**
	* Fungsi EvenRodehCode untuk menjalankan Algoritma kompresi Even Rodeh Code
	**/
	function EvenRodehCode(){
		$startTime 		= microtime(true);							//Untuk mencatat waktu mulai kompresi
		$freq 			= $this->getTextFrequency();				//mengambil frequensi dari text yang sudah ada
		$freqSorted 	= $this->sortByFrequency($freq, false);		//mengurutkan frequensi
		
		$this->saveDictionary($freqSorted);							//menyimpan frequensi yang sudah diurutkan sebagai kamus bahasa
		
		$evenRodehCode 	= $this->generateEvenRodeh(sizeof($freqSorted));	//mengenerate evenRodeh code sebanyak jumlah karakter
		$bit 			= $this->generateBit($freqSorted, $evenRodehCode);	//mengenerate bit dari evenRodehCode dengan frekuensi yang udah diurutkan
		$this->finalBit	= $this->generateFlag($bit);				//menbuat bit final dari bit hasil evenRodehCode dengan ditambah flag bit
		$finalFinalBit 	= $this->generateFlag($bit);

		$this->saveCompressToFile();								//menyimpan hasil kompresi

		$this->timeProccess	= microtime(true)-$startTime;			//menyimpan lama waktu untuk proses dalam detik
		$this->bitRate  	= strlen($this->finalBit) / sizeof($freqSorted);		//menghitung bitrate
		
		echo $finalFinalBit;
	}

	/**
	* Fungsi FixedLengthEncode untuk menjalankan Algoritma kompresi Fixed Length Encode
	**/
	function FixedLengthEncode(){
		$startTime 		= microtime(true);							//Untuk mencatat waktu mulai kompresi
		$freq 			= $this->getTextFrequency();				//mengambil frequensi dari text yang sudah ada
		$freqSorted 	= $this->sortByFrequency($freq, false);		//mengurutkan frequensi
		
		$this->saveDictionary($freqSorted, false);							//menyimpan frequensi yang sudah diurutkan sebagai kamus bahasa
		
		$fixedLengthEncodeCode 	= $this->generateFixedLengthEncodeCode(sizeof($freqSorted));	//mengenerate fixedLengthEncodeCode code sebanyak jumlah karakter

		$bit 			= $this->generateBit($freqSorted, $fixedLengthEncodeCode);	//mengenerate bit dari fixedLengthEncodeCode dengan frekuensi yang udah diurutkan
		
		$this->finalBit	= $this->generateFlag($bit);				//membuat bit final dari bit hasil fixedLengthEncodeCode dengan ditambah flag bit
		
		$this->saveCompressToFile(false);								//menyimpan hasil kompresi

		$this->timeProccess	= microtime(true)-$startTime;			//menyimpan lama waktu untuk proses dalam detik
		$this->bitRate  = strlen($this->finalBit) / sizeof($freqSorted);		//menghitung bitrate
		$finalFinalBit 	= $this->generateFlag($bit);
		echo $finalFinalBit;
		
	}	

	/**
	* Fungsi getRatioOfCompression untuk menghitung dan mendapatkan RC
	**/
	function getRatioOfCompression(){
		return round(strlen($this->firstBit)/strlen($this->finalBit),3);
	}

	/**
	* Fungsi getCompressionRatio untuk menghitung dan mendapatkan CR dalam persen
	**/
	function getCompressionRatio(){
		return round(strlen($this->finalBit)/strlen($this->firstBit)*100, 2 );
	}

	/**
	* Fungsi getSpaceSaving untuk menghitung dan mendapatkan SS dalam persen
	**/
	function getSpaceSaving(){
		return 100 - $this->getCompressionRatio();
	}

	/**
	* Fungsi getBitRate untuk menghitung dan mendapatkan bit rate
	**/
	function getBitRate(){
		return round($this->bitRate,2);
	}

	/**
	* Fungsi getTimeProccess untuk mendapatkan waktu proses 
	**/
	function getTimeProccess(){
		return round($this->timeProccess,5);
	}
	
	/**
	* Fungsi getTextInside untuk mendapatkan text dalam file yang digunakan 
	**/
	function getTextInside(){
	    $myfile = fopen($this->pathFile, "r") or die("Unable to open file!");		//membuka file
	    $this->textInside =  fread($myfile, filesize($this->pathFile));				//menyimpan text yang ada dalam file ke textInside
	    fclose($myfile);															//menutup file
	}


	/**
	* Fungsi getTextFrequency untuk mendapatkan frequensi dalam teks yang sudah di ambil 
	**/
	function getTextFrequency(){
		$freq = array(); 		// inisialisasi frequensi
		$this->firstBit = "";	// inisialisasi bit awal

		for ($i = 0; $i < strlen($this->textInside); $i++) { //melakukan perulangan untuk setiap char dalam text
	        
	        $letter = $this->textInside[$i]; //mengambil char ke-i dalam text
	        $this->firstBit .= sprintf("%08d",decbin(ord($letter)));		//menambahkan binary char ke-i dan disimpan ke firstbit
	        
	        if (array_key_exists($letter, $freq)) { //mengecek apakah char ke-i sudah ada dalam array frekuensi atau tidak
	            $freq[$letter]++;		//menambahkan jumlah char 
	        } else {
	            $freq[$letter] = 1;		//menginisialisasi jumlah char
	        }
	    }

	    return $freq;		//mengembalikan nilai frekuensi dalam array
	}

	/**
	* Fungsi generateFlag untuk menghitung dan mendapatkan bit yang sudah ditambahkan flag
	* $bit adalah bit yang belum ditambahkan flag
	**/
	function generateFlag($bit){
		$flag = 8-strlen($bit)%8 == 8 ? 0 : 8-strlen($bit)%8;		//menghitung jumlah padding bit
		$finalbit = $bit;				//menginisialisasi bit akhir

		for($i=0;$i<$flag;$i++)			//melakukan perulangan sebanyak padding bit
		    $finalbit.="0";				//menambahkan 0 di akhir final bit
		
		$finalbit.=sprintf("%08d",decbin($flag));		//menambahkan flag bit ke final bit

		return $finalbit; 				//mengembalikan final bit
	}

	/**
	* Fungsi generateBit untuk mendapatkan bit dari frekuensi dan array code
	* $freq adalah array frekuensi setiap char
	* $codes adalah array code 
	**/
	function generateBit($freq = array(), $codes = array()){
		$bit = "";		//inisialisasi bit

	    for($i = 0; $i < strlen($this->textInside); $i++)		//melakukan perulangan sebanyak text 
	        $bit.=$codes[array_search($this->textInside[$i], array_keys($freq))]; //mencari char ke-i dalam freq dan menambahkannya ke dalam bit

	    return $bit;		//mengembalikan nilai bit
	}

	/**
	* Fungsi generateEvenRodeh untuk mendapatkan array EvenRodehCode
	* $count adalah banyaknya jenis char dalam text
	**/
	function generateEvenRodeh($count = 0){
		$code 	= array();		// inisialisasi code


	    for($i = 0; $i < $count; $i++){		//melakukan perulangan sebanyak jenis char

	        if ($i<4) // apabila i < 4
	        	$code[$i] = sprintf("%03d",decbin($i)); // menambahkan 3 binary dari i
	        elseif ($i<8) //apabila i < 8
	        	$code[$i] = sprintf("%03d0",decbin($i)); // menambahkan 3 binary dari i ditambah 0 dibelakangnya
	        elseif($i<128) 
	        	$code[$i] = sprintf("%03d%d0",decbin(strlen(sprintf("%03d",decbin($i)))),decbin($i));
	        else
	        	$code[$i] = sprintf("%03d%03d%d0",decbin(strlen(strlen(sprintf("%03d",decbin($i))))),decbin($i));
	        
	    }
	    return $code; //mengembalikan nilai code dalam array

	}

	/**
	* Fungsi generateFixedLengthEncodeCode untuk mendapatkan array generateFixedLengthEncodeCode
	* $count adalah banyaknya jenis char dalam text
	**/
	function generateFixedLengthEncodeCode($count = 0){
		$code 	= array();		// inisialisasi code
        $length = strlen(sprintf("%d",decbin($count-1)));
	    for($i = 0; $i < $count; $i++){		//melakukan perulangan sebanyak jenis char
            $code[$i] = sprintf("%0".$length."d", decbin($i));
	    }
	    return $code; //mengembalikan nilai code dalam array
	}

	/**
	* Fungsi sortByFrequency untuk mengurutkan berdasarkan frequensi
	* $array adalah array yang akan diurutkan
	* $is_ascending adalah urutkan berdasarkan kecil - besar || default nilainya adalah true
	**/
	function sortByFrequency($array = array(), $is_ascending=true){
		$key = array_keys($array);		//mengambil key dari array
		$val = array_values($array);	// mengambil value dari array

		for ($i=0; $i<sizeof($key)-1; $i++) // melakukan perulangan sebanyak jumlah key
	        for ($j=0; $j<sizeof($key)-$i-1; $j++) { //melakukan perulangan sebanyak jumlah key - i
	            $k = $j+1;		// inisialisasi k
	            if (!$is_ascending) {		// apabila asc
	            	if ($val[$k] > $val[$j]){ // apabila nilai ke-k > nilai ke-j
	            		list($val[$j], $val[$k]) = array($val[$k], $val[$j]); //swap nilai
	                	list($key[$j], $key[$k]) = array($key[$k], $key[$j]); //swap key
	            	}
	            } elseif($val[$k] < $val[$j]){ // apabila nilai ke-k < nilai ke-j
	            	list($val[$j], $val[$k]) = array($val[$k], $val[$j]);	//swap nilai
	                list($key[$j], $key[$k]) = array($key[$k], $key[$j]);	//swap key
	            }
	        }
	    
	    $res = array(); // membuat array baru untuk dikembalikan
	    for ($i=0; $i < sizeof($key); $i++) // melakukan perulangan sebanyak jumlah key
	    	$res[$key[$i]] = $val[$i];		// menambahkan key => value ke dalam array
	    
		return $res; // mengembalikan nilai array yang sudah di urutkan
	}

	/**
	* Fungsi saveCompressToFile untuk menyimpan file hasil 
	* $is_evenRodeh adalah untuk menyimpan ketika menggunakan evenRodehCode || default true
	**/
	
	function saveCompressToFile($is_evenRodeh = true){
		$text 		= "";		//menginisialisasi text
		$extention 	= $is_evenRodeh ? ".ER" : ".FLE";	//megecek is_evenRodeh untuk menentukan ekstensi file


    	for($i = 0; $i < strlen($this->finalBit)/8; $i++)		// melakukan perulangan sebanyak bit akhir / 8
        	$text.=chr(bindec(substr($this->finalBit,$i*8,8)));		// menambahkan char dari 8 digit bit akhir ke dalam text
	
		$newfile = fopen("../hasil/".$this->filename.$extention,"w");
    	fwrite($newfile,$text); // menyimpan text ke dalam file
    	fclose($newfile);		// menutup file
    }
	
	/**
	* Fungsi saveDictionary untuk menyimpan file directory
	* $freq adalah frequensi yang udah diurutkan
	* $is_evenRodeh adalah untuk menyimpan ketika menggunakan evenRodehCode || default true
	**/
	function saveDictionary($freq, $is_evenRodeh = true){
		$keys = array_keys($freq); 		// mengambil semua key dalam freq
		$text = "";						// menginisialisasi text
		$extention 	= $is_evenRodeh ? ".DIRER" : ".DIRFLE"; //megecek is_evenRodeh untuk menentukan ekstensi file

		foreach ($keys as $v) //melakukan perulangan sebanyak key
			$text.= $v;		//menambahkan text key ke dalam text

		$newfile = fopen("../dictionary/".$this->filename.$extention,"w"); //membuat file dictionary
    	fwrite($newfile,$text);		//meyimpan text ke dlam file
    	fclose($newfile);			//menutuo file
	}
	function getBitBefore(){
		return strlen($this->firstBit)/8;
	}
	function getBitAfter(){
		return strlen($this->finalBit)/8;
	}
}
?>