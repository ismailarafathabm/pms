
<?php 
$flodername = !isset($_GET['foldername']) || trim($_GET['foldername']) ===  '' ? '' : $_GET['foldername'];
if($flodername === ""){
	echo "Folder Name is missing";
	die();
}


$fname = !isset($_GET['fname']) || trim($_GET['fname']) ===  '' ? '' : $_GET['fname'];
if($fname === ""){
	echo "file name is missing";
	die();
}

$dwname = !isset($_GET['dwname']) || trim($_GET['dwname']) ===  '' ? '' : $_GET['dwname'];
if($dwname === ""){
	echo "Donwload name is missing";
	die();
}
$folder = "";
switch($flodername){
	case 'contract':
		$folder = "contract";
		break;
	default : 
		$folder = "";
	break;
	
}
/* You may need these ini settings too */ 
set_time_limit(0); 
ini_set('memory_limit', '512M'); 
/*set your download file path here.   */ 
$filePath = "../assets/". $folder ."/" . $fname; 
/* calls download function  */
downloadFiles($filePath,$dwname); 
?>

<?php 
function mimeTypes() 
{ 
	/* Just add any required MIME type if you are going to download something not listed here.*/ 
	$mime_types = array(
		"323" => "text/h323", 
		"acx" => "application/internet-property-stream", 
		"ai" => "application/postscript", 
		"aif" => "audio/x-aiff", 
		"aifc" => "audio/x-aiff", 
		"aiff" => "audio/x-aiff", 
		"asf" => "video/x-ms-asf", 
		"asr" => "video/x-ms-asf", 
		"asx" => "video/x-ms-asf", 
		"au" => "audio/basic", 
		"avi" => "video/x-msvideo", 
		"axs" => "application/olescript", 
		"bas" => "text/plain", 
		"bcpio" => "application/x-bcpio", 
		"bin" => "application/octet-stream", 
		"bmp" => "image/bmp", 
		"c" => "text/plain", 
		"cat" => "application/vnd.ms-pkiseccat", 
		"cdf" => "application/x-cdf", 
		"cer" => "application/x-x509-ca-cert", 
		"class" => "application/octet-stream", 
		"clp" => "application/x-msclip", 
		"cmx" => "image/x-cmx", 
		"cod" => "image/cis-cod", 
		"cpio" => "application/x-cpio", 
		"crd" => "application/x-mscardfile", 
		"crl" => "application/pkix-crl", 
		"crt" => "application/x-x509-ca-cert", 
		"csh" => "application/x-csh", 
		"css" => "text/css", 
		"dcr" => "application/x-director", 
		"der" => "application/x-x509-ca-cert", 
		"dir" => "application/x-director", 
		"dll" => "application/x-msdownload", 
		"dms" => "application/octet-stream", 
		"doc" => "application/msword", 
		"dot" => "application/msword", 
		"dvi" => "application/x-dvi", 
		"dxr" => "application/x-director", 
		"eps" => "application/postscript", 
		"etx" => "text/x-setext", 
		"evy" => "application/envoy", 
		"exe" => "application/octet-stream", 
		"fif" => "application/fractals", 
		"flr" => "x-world/x-vrml", 
		"gif" => "image/gif", 
		"gtar" => "application/x-gtar", 
		"gz" => "application/x-gzip", 
		"h" => "text/plain", 
		"hdf" => "application/x-hdf", 
		"hlp" => "application/winhlp", 
		"hqx" => "application/mac-binhex40", 
		"hta" => "application/hta", 
		"htc" => "text/x-component", 
		"htm" => "text/html", 
		"html" => "text/html", 
		"htt" => "text/webviewhtml", 
		"ico" => "image/x-icon", 
		"ief" => "image/ief", 
		"iii" => "application/x-iphone", 
		"ins" => "application/x-internet-signup", 
		"isp" => "application/x-internet-signup", 
		"jfif" => "image/pipeg", 
		"jpe" => "image/jpeg", 
		"jpeg" => "image/jpeg", 
		"jpg" => "image/jpeg", 
		"js" => "application/x-javascript", 
		"latex" => "application/x-latex", 
		"lha" => "application/octet-stream", 
		"lsf" => "video/x-la-asf", 
		"lsx" => "video/x-la-asf", 
		"lzh" => "application/octet-stream", 
		"m13" => "application/x-msmediaview", 
		"m14" => "application/x-msmediaview", 
		"m3u" => "audio/x-mpegurl", 
		"man" => "application/x-troff-man", 
		"mdb" => "application/x-msaccess", 
		"me" => "application/x-troff-me", 
		"mht" => "message/rfc822", 
		"mhtml" => "message/rfc822", 
		"mid" => "audio/mid", 
		"mny" => "application/x-msmoney", 
		"mov" => "video/quicktime", 
		"movie" => "video/x-sgi-movie", 
		"mp2" => "video/mpeg", 
		"mp3" => "audio/mpeg", 
		"mpa" => "video/mpeg", 
		"mpe" => "video/mpeg", 
		"mpeg" => "video/mpeg", 
		"mpg" => "video/mpeg", 
		"mpp" => "application/vnd.ms-project", 
		"mpv2" => "video/mpeg", 
		"ms" => "application/x-troff-ms", 
		"mvb" => "application/x-msmediaview", 
		"nws" => "message/rfc822", 
		"oda" => "application/oda", 
		"p10" => "application/pkcs10", 
		"p12" => "application/x-pkcs12", 
		"p7b" => "application/x-pkcs7-certificates", 
		"p7c" => "application/x-pkcs7-mime", 
		"p7m" => "application/x-pkcs7-mime", 
		"p7r" => "application/x-pkcs7-certreqresp", 
		"p7s" => "application/x-pkcs7-signature", 
		"pbm" => "image/x-portable-bitmap", 
		"pdf" => "application/pdf", 
		"pfx" => "application/x-pkcs12", 
		"pgm" => "image/x-portable-graymap", 
		"pko" => "application/ynd.ms-pkipko", 
		"pma" => "application/x-perfmon", 
		"pmc" => "application/x-perfmon", 
		"pml" => "application/x-perfmon", 
		"pmr" => "application/x-perfmon", 
		"pmw" => "application/x-perfmon", 
		"pnm" => "image/x-portable-anymap", 
		"pot" => "application/vnd.ms-powerpoint", 
		"ppm" => "image/x-portable-pixmap", 
		"pps" => "application/vnd.ms-powerpoint", 
		"ppt" => "application/vnd.ms-powerpoint", 
		"prf" => "application/pics-rules", 
		"ps" => "application/postscript", 
		"pub" => "application/x-mspublisher", 
		"qt" => "video/quicktime", 
		"ra" => "audio/x-pn-realaudio", 
		"ram" => "audio/x-pn-realaudio", 
		"ras" => "image/x-cmu-raster", 
		"rgb" => "image/x-rgb", 
		"rmi" => "audio/mid", 
		"roff" => "application/x-troff", 
		"rtf" => "application/rtf", 
		"rtx" => "text/richtext", 
		"scd" => "application/x-msschedule", 
		"sct" => "text/scriptlet", 
		"setpay" => "application/set-payment-initiation", 
		"setreg" => "application/set-registration-initiation", 
		"sh" => "application/x-sh", 
		"shar" => "application/x-shar", 
		"sit" => "application/x-stuffit", 
		"snd" => "audio/basic", 
		"spc" => "application/x-pkcs7-certificates", 
		"spl" => "application/futuresplash", 
		"src" => "application/x-wais-source", 
		"sst" => "application/vnd.ms-pkicertstore", 
		"stl" => "application/vnd.ms-pkistl", 
		"stm" => "text/html", 
		"svg" => "image/svg+xml", 
		"sv4cpio" => "application/x-sv4cpio", 
		"sv4crc" => "application/x-sv4crc", 
		"t" => "application/x-troff", 
		"tar" => "application/x-tar", 
		"tcl" => "application/x-tcl", 
		"tex" => "application/x-tex", 
		"texi" => "application/x-texinfo", 
		"texinfo" => "application/x-texinfo", 
		"tgz" => "application/x-compressed", 
		"tif" => "image/tiff", 
		"tiff" => "image/tiff", 
		"tr" => "application/x-troff", 
		"trm" => "application/x-msterminal", 
		"tsv" => "text/tab-separated-values", 
		"txt" => "text/plain", 
		"uls" => "text/iuls", 
		"ustar" => "application/x-ustar", 
		"vcf" => "text/x-vcard", 
		"vrml" => "x-world/x-vrml", 
		"wav" => "audio/x-wav", 
		"wcm" => "application/vnd.ms-works", 
		"wdb" => "application/vnd.ms-works", 
		"wks" => "application/vnd.ms-works", 
		"wmf" => "application/x-msmetafile", 
		"wps" => "application/vnd.ms-works", 
		"wri" => "application/x-mswrite", 
		"wrl" => "x-world/x-vrml", 
		"wrz" => "x-world/x-vrml", 
		"xaf" => "x-world/x-vrml", 
		"xbm" => "image/x-xbitmap", 
		"xla" => "application/vnd.ms-excel", 
		"xlc" => "application/vnd.ms-excel", 
		"xlm" => "application/vnd.ms-excel", 
		"xls" => "application/vnd.ms-excel", 
		"xlt" => "application/vnd.ms-excel", 
		"xlw" => "application/vnd.ms-excel", 
		"xof" => "x-world/x-vrml", 
		"xpm" => "image/x-xpixmap", 
		"xwd" => "image/x-xwindowdump", 
		"z" => "application/x-compress", 
		"rar" => "application/x-rar-compressed", 
		"zip" => "application/zip"); 
	return $mime_types;                     
} 
?>

<!-- https://github.com/Godsont/auth-with-credentials/blob/main/components/LoginForm.jsx -->
<?php 
function downloadFiles($filePath,$dwname) 
{     
    if(!empty($filePath)) 
    { 
        $fileInfo = pathinfo($filePath); 
        $fileName  = $fileInfo['basename']; 
        $fileExtnesion   = $fileInfo['extension']; 
        $default_contentType = "application/octet-stream"; 
        $content_types_list = mimeTypes(); 
        if (array_key_exists($fileExtnesion, $content_types_list))  
        { 
            $contentType = $content_types_list[$fileExtnesion]; 
        } 
        else 
        { 
            $contentType =  $default_contentType; 
        } 
        if(file_exists($filePath)) 
        { 
            $size = filesize($filePath); 
            $offset = 0; 
            $length = $size; 
            if(isset($_SERVER['HTTP_RANGE'])) 
            { 
                preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches); 
                $offset = intval($matches[1]); 
                $length = intval($matches[2]) - $offset; 
                $fhandle = fopen($filePath, 'r'); 
		fseek($fhandle, $offset); 
                $data = fread($fhandle, $length); 
                fclose($fhandle); 
                header('HTTP/1.1 206 Partial Content'); 
                header('Content-Range: bytes ' . $offset . '-' . ($offset + $length) . '/' . $size); 
            }
            //Heasers for download
            header("Content-Disposition: attachment;filename=".$dwname); 
            //header("Content-Disposition: attachment;filename=DOWNLOAD.pdf"); 
            header('Content-Type: '.$contentType); 
            header("Accept-Ranges: bytes"); 
            header("Pragma: public"); 
            header("Expires: -1"); 
            header("Cache-Control: no-cache"); 
            header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0"); 
            header("Content-Length: ".filesize($filePath)); 
            $chunksize = 20 * (1024 * 1024); //8MB (highest possible fread length) 
            if ($size > $chunksize) 
            { 
              $handle = fopen($_FILES["file"]["tmp_name"], 'rb'); 
              $buffer = ''; 
              while (!feof($handle) && (connection_status() === CONNECTION_NORMAL))  
              { 
                $buffer = fread($handle, $chunksize); 
                print $buffer; 
                ob_flush(); 
                flush(); 
              } 
              if(connection_status() !== CONNECTION_NORMAL) 
              { 
                echo "Connection aborted"; 
              } 
              fclose($handle); 
            } 
            else  
            { 
              ob_clean(); 
              flush(); 
              readfile($filePath); 
            } 
         } 
         else 
         { 
           echo 'File does not exist!'; 
         } 
    } 
    else 
    { 
        echo 'There is no file to download!'; 
    } 
}   
?>