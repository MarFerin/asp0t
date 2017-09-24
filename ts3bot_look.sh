

function greenMessage {
    echo -e "\\033[32;1m${@}\033[0m"
}

function kekMessage {
    echo -e "\\033[36;1m${@}\033[0m"
}
clear
greenMessage "################################################"
kekMessage  "               Sinusbots Installer"
greenMessage "################################################"
sleep 2
kekMessage  "Downloading Youtube DL"
apt-get update && apt-get install curl python -y
curl -L https://yt-dl.org/downloads/latest/youtube-dl -o /usr/local/bin/youtube-dl
chmod a+rx /usr/local/bin/youtube-dl
kekMessage  "Youtube DL Downloaded Succesfully..."
sleep 2
mkdir /home/ts3bot
kekMessage  "Directory has been Created"
sleep 1
sleep 2
sleep 2
kekMessage  "Updating"
apt-get update
kekMessage  "Upgrading"
apt-get upgrade
clear
kekMessage  "Verifying"
apt-get install x11vnc xinit xvfb libxcursor1 ca-certificates bzip2 curl libglib2.0-0 nano screen -y
rm -rf /tmp/.X11-unix/X40 /tmp/.sinusbot.lock
kekMessage  "               Downloading SinusBot"
cd /home/ts3bot
cd && curl -O https://www.sinusbot.com/dl/sinusbot-beta.tar.bz2
kekMessage  "               Downloading TS3"
cd && wget http://dl.4players.de/ts/releases/3.0.19.4/TeamSpeak3-Client-linux_amd64-3.0.19.4.run
cd && tar xfvx sinusbot-beta.tar.bz2
cd && chmod 755 TeamSpeak3-Client-linux_amd64-3.0.19.4.run
cd && clear 
echo "Press ENTER, Q, Y, ENTER"
sleep 2
cd && ./TeamSpeak3-Client-linux_amd64-3.0.19.4.run
cd && cp plugin/libsoundbot_plugin.so TeamSpeak3-Client-linux_amd64/plugins/
cd && mv config.ini.dist config.ini
clear
rm config.ini
wget https://www.dropbox.com/s/9xdnjqws6957e02/config.ini?dl=0 -O config.ini
clear
kekMessage " Initiating SinusBot"
screen -AmdS ts3bot /home/ts3bot/sinusbot -pwreset="foobar" -RunningAsRootIsEvilAndIKnowThat
kekMessage "SinusBot installed correctly, using ports "
kekMessage "8101"
kekMessage "username= admin password= foobar "
exit