import configparser 
import os
import sys

#print(sys.argv[1])

#ADD VERSION CHECKING!!!!
os.system("tar -xzvf /home/vm164/temp/APIv12.tgz -C /home/vm164/temp/")

conf = configparser.ConfigParser()
conf.read("/home/vm164/temp/bundleConfig.cfg")

temp = conf.get("apiBundleConfig", "tempLocation")
apiLocation = conf.get("apiBundleConfig", "apiCode")
logLocation = conf.get("apiBundleConfig", "logCode")

os.system("mv " + temp + "/apiServer.php " + " " + apiLocation)
os.system("mv " + temp + "/logRabbitMQ.ini " + " " + logLocation)

os.system("rm -r /home/vm164/temp/APIv12.tgz")
os.system("rm -r /home/vm164/temp/bundleConfig.cfg")

os.system("echo")
os.system("echo Operation completed successfully.")
os.system("exit")
