import configparser 
import os
import sys

ver = (sys.argv[1])
#ver = "15"

bundleName = (sys.argv[2])

print ("\r\n")
print (bundleName)
print ("\r\n")

os.system("tar -xzvf /home/vm1/temp/FE_"+ bundleName + "_v" + ver + ".tgz -C /home/vm1/temp/")

conf = configparser.ConfigParser()
conf.read("/home/vm1/temp/bundle.ini")

dest = conf.get("destinations", str(bundleName))

#os.system("rm -rf /home/vm1/temp/rabbitmqphp_example/.git")
os.system("cp " + temp + " API_apiServer_v" + ver + " " + dest)

os.system("rm -r /home/vm164/temp/API_apiServer_v" + ver + ".tgz")
os.system("rm -r /home/vm164/temp/bundle.ini")

os.system("echo")
os.system("echo Operation completed successfully.")
os.system("exit")
