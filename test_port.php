<?
$serial = new DOTNET('system', 'System.IO.Ports.SerialPort');
$serial->PortName = 'COM5';
$serial->Open();

?>