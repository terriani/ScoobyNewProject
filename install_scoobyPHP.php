<?php

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    die('Instalador do ScoobyPHP, só pode ser executado em linha de comando');
}
echo "Bem vindo a instalação do ScoobyPHP...\r\n";
echo "Por favor informe o nome do seu novo projeto!\r\n";
sleep(2);
$name = fgets(STDIN);
$name = ucfirst($name);
$name = rtrim($name);
echo "Clonando o repositório do github...\r\n\r\n";
sleep(2);
shell_exec('git clone https://github.com/terriani/ScoobyPHP.git');
echo "\r\n";
shell_exec('sudo chmod 777 -R ScoobyPHP');
$siteName = file_get_contents('ScoobyPHP/Config/config.php');
$siteName = strtr($siteName, ['ScoobyPHP' => $name]);
$f = fopen("ScoobyPHP/Config/config.php", 'w+');
fwrite($f, $siteName);
fclose($f);
echo "$name criado em 'App/Models' com sucesso. \r\n";
shell_exec('mv ScoobyPHP '. $name);
chdir($name);
echo "instalando os pacotes via composer...\r\n\r\n";
shell_exec('composer install');
echo "\r\n";
echo "instalando os pacotes via npm...\r\n\r\n";
shell_exec('npm install');
sleep(0.2);
shell_exec('rm -rf .git');
echo "ScoobyPHP instalado com sucesso \r\n\r\n";
echo "FAÇA ALGO INCRÍVEL...\r\n\r\n";