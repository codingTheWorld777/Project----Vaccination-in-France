# Project----Vaccination-Website

### Name of student: Huu Khai NGUYEN
### Connect to remote-server: [dev-isi.utt.fr](http://dev-isi.utt.fr/~nguyenh3/lo07_tp/projet)
(We need to turn on VPN to connect to remote-server, this step is just for a test on the teacher side.)

## --[EN-Description]--
### 1) Introduction
- As part of a [branch course of Web development (LO07)](https://moodle.utt.fr/course/search.php?search=lo07) directed by **Marc LEMERCIER** at the [University of Technology of Troyes](https://www.utt.fr),
I have to develop a website about the management of vaccination in FRANCE. The aim of this website is to provide you all infomations you need for the vaccination against Covid-19 that relate to vaccines, vaccination center, vaccine's stock and appoinment for vaccination...

### 2) Technologies and programming language
- HTML/CSS, Bootstrap and Javascript for client-side and PHP for server-side.
- mySQL to connect to phpMyAdmin in order to get or modify the informations of this  vaccination's campagne.
- Design-pattern MVC to organize my project.
		
</br>

### 3) Utilisation in localhost
- You need to install local server on your computer such as MAMP (on mac) or XAMPP (on window). It depends on your choice ;)
- After the installation of local server, you need an IDE to execute codes. I recommend you to download Netbeans. Then, you need to configurate your IDE to run codes on your local server...
- Next step, you must create your own databases in phpMyAdmin at localhost (you can refer on Youtube how to connect to phpMyAdmin on your computer) and then import 2 files in **root/outil** to your databases.
- After finishing the configuration and the importation of databases, you need to change the config's variable in **root/app/controler/config.php**. You need to change the values of **dbname**, **username** and **password**.
**dbname** is your database's name, the values of **username** and **password** are usually **'root'* by default. Finally, run your program to see what you want to see 🤘

### 4) Deployment to Heroku
- See here: [Vaccination in France](https://vaccination-in-france.herokuapp.com/app/router/router2.php?action=accueil)

</p>
</details>
