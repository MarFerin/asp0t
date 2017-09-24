

function greenMessage {
    echo -e "\\033[32;1m${@}\033[0m"
}

function kekMessage {
    echo -e "\\033[36;1m${@}\033[0m"
}

if [ -z "$1" ]
then
echo "./RAW.sh (Usuariobot)"
exit 0
fi


BOTUSER = $1


clear
greenMessage "################################################"
kekMessage""
kekMessage  "               Unlimited Sinusbots"
kekMessage  "                   Script by"
kekMessage  "                  Look Designs"
kekMessage  "              _____________________"
kekMessage ""
kekMessage  "                 ts.lovecrew.us"
kekMessage""
greenMessage "################################################"
sleep 2
kekMessage  "               Usuario"
sleep 2
adduser --disabled-login --force-badname $1
kekMessage  "               Usuario Login"
sleep 1
sleep 2
sleep 2
kekMessage  "               Actualizando"
apt-get update
kekMessage  "               Mejorando"
apt-get upgrade
clear
kekMessage  "               Descargando y instalando"
apt-get install x11vnc xinit xvfb libxcursor1 ca-certificates bzip2 curl libglib2.0-0 nano screen -y
rm -rf /tmp/.X11-unix/X40 /tmp/.sinusbot.lock
kekMessage  "               Descargando SinusBot"
sudo -u $1 -H sh -c ' cd && curl -O https://www.sinusbot.com/dl/sinusbot-beta.tar.bz2'
kekMessage  "               Descargando Ts3"
sudo -u $1 -H sh -c ' cd && wget http://dl.4players.de/ts/releases/3.0.19.4/TeamSpeak3-Client-linux_amd64-3.0.19.4.run'
sudo -u $1 -H sh -c ' cd && tar xfvx sinusbot-beta.tar.bz2'
sudo -u $1 -H sh -c ' cd && chmod 755 TeamSpeak3-Client-linux_amd64-3.0.19.4.run '
sudo -u $1 -H sh -c ' cd && clear '
echo "Presiona ENTER, Q, Y"
sleep 2
sudo -u $1 -H sh -c ' cd && ./TeamSpeak3-Client-linux_amd64-3.0.19.4.run'

sudo -u $1 -H sh -c ' cd && cp plugin/libsoundbot_plugin.so TeamSpeak3-Client-linux_amd64/plugins/'
sudo -u $1 -H sh -c ' cd && mv config.ini.dist config.ini'
clear
echo "Selecciona el puerto y el path"
sleep 2
sudo -u $1 -H sh -c ' cd && nano config.ini'
clear
sleep 2
sudo -u $1 -H sh -c 'script /dev/null && cd && screen -AmdS BOT ./sinusbot -pwreset="foobar"'
sudo -u $1 -H sh -c 'screen -r'
echo "Enciende el bot "
echo "screen -S BOTNAME ./sinusbot'"
