<?php

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    die('Instalador do ScoobyPHP, só pode ser executado em linha de comando');
}
echo "\033[1;90m Bem vindo a instalação do ScoobyPHP... \033[0;97m \r\n";
echo "Por favor informe o nome do seu novo projeto!\r\n";
sleep(2);
$name = fgets(STDIN);
$name = ucfirst($name);
$name = rtrim($name);
echo "\033[1;90m Clonando o repositório do github... \033[0;97m \r\n\r\n";
sleep(2);
shell_exec('git clone https://github.com/terriani/ScoobyPHP.git');
echo "\r\n";
echo "\033[1;90m Por favor informa a senha do seu usuário para configuração do cache da aplicação... \033[1;97m \r\n";
shell_exec('sudo chmod 777 -R ScoobyPHP');
$siteName = file_get_contents('ScoobyPHP/Config/config.php');
$siteName = strtr($siteName, ['ScoobyPHP' => $name]);
$f = fopen("ScoobyPHP/Config/config.php", 'w+');
fwrite($f, $siteName);
fclose($f);
echo "\033[1;90m $name criado em 'App/Models' com sucesso. \033[0;97m \r\n";
shell_exec('mv ScoobyPHP '. $name);
chdir($name);
echo "\033[1;90m instalando os pacotes via composer... \033[0;97m \r\n\r\n";
shell_exec('composer install');
echo "\r\n";
echo "\033[1;90m instalando os pacotes via npm...\033[0;97m \r\n\r\n";
shell_exec('npm install');
sleep(0.2);
shell_exec('rm -rf .git');
echo "\033[1;90m ScoobyPHP instalado com sucesso \033[0;97m \r\n\r\n";
echo "\033[1;32m FAÇA ALGO INCRÍVEL... \033[0;97m\r\n\r\n";