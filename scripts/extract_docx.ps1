param([string]$docx = 'ACADEMIC-PROJECT-PROPOSAL-Dagumbal.docx')
Add-Type -AssemblyName System.IO.Compression.FileSystem
$zip = [System.IO.Compression.ZipFile]::OpenRead($docx)
$entry = $zip.GetEntry('word/document.xml')
if ($entry -eq $null) {
    Write-Error "No word/document.xml in $docx"
    exit 1
}
$sr = New-Object System.IO.StreamReader($entry.Open())
$xml = $sr.ReadToEnd()
$sr.Close()
$zip.Dispose()
$text = $xml -replace '</w:p>','`n' -replace '<[^>]+>',''
$text
