#!/usr/bin/python
print("Content-Type: text/html\r\n")
print("hello here is kmlparser.py")
import mysql.connector
import lxml
import pykml
import cgitb
cgitb.enable()
from pykml import parser #https://umar-yusuf.blogspot.com/2018/06/unable-to-parse-kml-file-in-python-3.html
from bs4 import BeautifulSoup

path_to_kml = "/home/nik/Desktop/web/kmls/geonode-population_data_per_block.kml"

with open(path_to_kml,"r") as f:
        #print("File Found")
    city = parser.parse(f).getroot().Document.Folder

namelists = []
coords = []
pop_per_block = []
#print(city.Document.Folder.Placemark.name)
for pm in city.Placemark:
    #print(pm.name)
    namelists.append(pm.name)
    htmltoparse=str(pm.description)
    soup = BeautifulSoup(htmltoparse,"lxml")
    li= soup.findAll("li")
    if len(li)<=2 :
        pop_per_block.append(0)
    else:
        #print(li[2])
        pop =li[2].find("span", class_= "atr-value",text=True).getText()
        pop_per_block.append(pop)
        #print(pop)
    #print(pm.MultiGeometry.Polygon.outerBoundaryIs.LinearRing.coordinates)
    #if len([[pm.MultiGeometry.Polygon.outerBoundaryIs.LinearRing.coordinates]])>1000:
        #print(len([pm.MultiGeometry.Polygon.outerBoundaryIs.LinearRing.coordinates]))
    coords.append([pm.MultiGeometry.Polygon.outerBoundaryIs.LinearRing.coordinates])


#print(len(namelists))
#print(coords)
#print(len(pop_per_block))




cnx = mysql.connector.connect(user='root', password='',
                              host='127.0.0.1',database='cities')


mycursor = cnx.cursor()

#mycursor.execute("SHOW TABLES")

#for x in mycursor:
#    print(x)


#sql = "INSERT INTO Admins (A_FullName, A_username, password) VALUES (%s, %s,%s)"
#val = [("admin", "admin","password")]

sql_insert = "INSERT INTO polygon(P_linear_coords,P_population) VALUES ( %s, %s)"
for i in range(0,1000):
    values = ' '.join(str(v) for v in coords[i])
    #print(len(values))
    val =[values,str(pop_per_block[i])]
    #print(val)
    mycursor.execute(sql_insert, val)

cnx.commit()

#mycursor.execute("SELECT * FROM Admins")

#myresult = mycursor.fetchall()
#for x in myresult:
#    print(x)

#print("the end")
