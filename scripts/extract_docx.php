<?php
if ($argc < 2) {
    echo "Usage: php extract_docx.php path/to/file.docx\n";
    exit(1);
}
$path = $argv[1];
if (!file_exists($path)) {
    echo "File not found: $path\n";
    exit(1);
}
$zip = new ZipArchive;
if ($zip->open($path) !== true) {
    echo "Failed to open file: $path\n";
    exit(1);
}
$index = $zip->locateName('word/document.xml');
if ($index === false) {
    echo "No document.xml inside docx\n";
    $zip->close();
    exit(1);
}
$xml = $zip->getFromIndex($index);
$zip->close();
// Replace paragraph and table breaks with newlines
$xml = str_replace(['</w:p>', '</w:tbl>'], "\n", $xml);
// Remove all tags
$text = strip_tags($xml);
$text = html_entity_decode($text, ENT_QUOTES | ENT_XML1, 'UTF-8');
// Normalize whitespace
$text = preg_replace('/\s+/', ' ', $text);
// Break on our inserted newlines
$text = str_replace(' \n ', "\n", $text);
echo trim($text) . "\n";
