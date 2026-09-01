@echo off
:: Run this file as Administrator (Right-click → Run as administrator)
echo Adding amrtm.com.sa to hosts file...
echo 127.0.0.1 amrtm.com.sa >> C:\Windows\System32\drivers\etc\hosts
echo Done! Restarting Apache...
net stop wampapache64
net start wampapache64
echo.
echo Finished! Open http://amrtm.com.sa in your browser.
pause
