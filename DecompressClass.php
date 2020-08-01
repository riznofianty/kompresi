<?php
/**
* Class Decompress
* Kelas yang digunakan untuk meng-compress dan men-decompress file 
*/
class Decompress 
{
    private $pathFile; 		//lokasi file yang akan di-compress atau di-decompress
	private $filename; 		//nama file yang akan di-compress atau di-decompress
	private $textInside; 	//isi text yang ada di dalam file
	private $firstBit;		//bit awal dari text yang baru dibuka
	private $finalBit;		//bit akhir dari text yang sudah di-compress atau di-decompress
	private $timeProccess;	//lama waktu yang digunakan selama proses dalam detik
    private $bitRate;		//BitRate
    private $dictionary;

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
	* Fungsi getTextInside untuk mendapatkan text dalam file yang digunakan 
	**/
	function getTextInside(){
	    $myfile = fopen($this->pathFile, "r") or die("Unable to open file!");		//membuka file
	    $this->textInside =  fread($myfile, filesize($this->pathFile));				//menyimpan text yang ada dalam file ke textInside
	    fclose($myfile);															//menutup file
    }
    
    function evenRodeh(){
        $startTime 		= microtime(true);		
        $realBit        = $this->getRealBit(); 
        
        $this->readDictionary();
        
        $codes          = $this->generateEvenRodehCode();
        $decompressedString= $this->getDecompressedString($realBit, $codes);

        $this->timeProccess = microtime(true)-$startTime;
        $this->bitRate      = strlen($this->finalBit) / sizeof($codes);

        echo $this->textInside;
    }
    function decString(){
        $startTime        = microtime(true);      
        $realBit        = $this->getRealBit(); 
        
        $this->readDictionary();
        
        $codes          = $this->generateEvenRodehCode();
        $decompressedString= $this->getDecompressedString($realBit, $codes);

        $this->timeProccess = microtime(true)-$startTime;
        $this->bitRate      = strlen($this->finalBit) / sizeof($codes);
        echo $decompressedString;
    }
    function fixedLengthEncode(){
        $startTime      = microtime(true);      
        $realBit        = $this->getRealBit(); 
        
        $this->readDictionary(false);
        
        $codes          = $this->generateFixedLengthEncodeCode();
        $decompressedString= $this->getDecompressedString($realBit, $codes);

        $this->timeProccess = microtime(true)-$startTime;
        $this->bitRate      = strlen($this->finalBit) / sizeof($codes);

        echo $this->textInside;
       
    }
    function decStringFLE(){
         $startTime      = microtime(true);      
        $realBit        = $this->getRealBit(); 
        
        $this->readDictionary(false);
        
        $codes          = $this->generateFixedLengthEncodeCode();
        $decompressedString= $this->getDecompressedString($realBit, $codes);

        $this->timeProccess = microtime(true)-$startTime;
        $this->bitRate      = strlen($this->finalBit) / sizeof($codes);
        echo $decompressedString;
    }

    /**
    * untuk ngambil bit asli yg sudah dikompres 
    **/
    function getRealBit()
    {
        $bit ="";
        /*

        */
        $this->firstBit = "";	// inisialisasi bit awal
		for ($i = 0; $i < strlen($this->textInside); $i++) { //melakukan perulangan untuk setiap char dalam text
            $letter = $this->textInside[$i]; //mengambil char ke-i dalam text
	        $this->firstBit .= sprintf("%08d",decbin(ord($letter)));		//menambahkan binary char ke-i dan disimpan ke firstbit
        }
        $bit = $this->firstBit;     //masih ada padding & flag
        $flag = substr($bit,-8);    //ngambil 8 digit terakhir dr biner
        $padding = bindec($flag);   //ngubah dr flag jadi des
        $bit = substr($bit, 0, strlen($bit)-$padding-8);    //untuk mengurangi nilai total bit dengan padding&flag 
        return $bit;		//mengembalikan nilai frekuensi dalam array
    }
    function readDictionary($is_EvenRodeh=true){
        $extention 	= $is_EvenRodeh ? ".DIRER" : ".DIRFLE";
        $myfile = fopen("../dictionary/".$this->filename.$extention, "r") or die("Unable to open file!");		//membuka file
	    $this->dictionary =  fread($myfile, filesize("../dictionary/".$this->filename.$extention));				//menyimpan text yang ada dalam file ke textInside
	    fclose($myfile);
    }

    /**
    * Fungsi generateEvenRodeh untuk mendapatkan array EvenRodehCode
    * $count adalah banyaknya jenis char dalam text
    **/
    function generateEvenRodehCode(){

        $code   = array();      // inisialisasi code
        $dic = $this->dictionary;
        $count  =  strlen($dic);
        for($i = 0; $i < $count; $i++){     //melakukan perulangan sebanyak jenis char

            if ($i<4) // apabila i < 4
                $code[sprintf("%03d",decbin($i))] = $dic[$i]; // menambahkan 3 binary dari i
            elseif ($i<8) //apabila i < 8
                $code[sprintf("%03d0",decbin($i))] = $dic[$i]; // menambahkan 3 binary dari i ditambah 0 dibelakangnya
            else 
                $code[sprintf("%03d%d0",decbin(strlen(sprintf("%03d",decbin($i)))),decbin($i))] = $dic[$i]; 
            
        }
        return $code; //mengembalikan nilai code dalam array
    }

    /**
    * Fungsi generateFixedLengthEncodeCode untuk mendapatkan array generateFixedLengthEncodeCode
    * $count adalah banyaknya jenis char dalam text
    **/
    function generateFixedLengthEncodeCode(){
        $code   = array();      // inisialisasi code
        $dic = $this->dictionary;
        $count  =  strlen($dic);
        $length = strlen(sprintf("%d",decbin($count-1)));
        for($i = 0; $i < $count; $i++){     //melakukan perulangan sebanyak jenis char
            $code[sprintf("%0".$length."d", decbin($i))] = $dic[$i];
        }
        return $code; //mengembalikan nilai code dalam array
    }

    function getDecompressedString($realBit = "", $codes = array()){
        $text = "";
        $this->finalBit = "";

        $pos = 0;
        $len = 0;
        
        for ($i=0; $i < strlen($realBit); $i++) { 
            $len++;
            if(array_key_exists(substr($realBit, $pos, $len), $codes)){
                
                $letter  = $codes[substr($realBit, $pos, $len)];

                $this->finalBit .= sprintf("%08d",decbin(ord($letter)));

                $text .= $letter;
                $pos = $i+1;
                $len = 0;
            }
        }
        return $text;
    }

    function getTimeProccess(){
		return round($this->timeProccess,5);
	}

}
?>