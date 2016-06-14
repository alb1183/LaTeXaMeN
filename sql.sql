/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.73-community : Database - latexamen
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tex_config` */

DROP TABLE IF EXISTS `tex_config`;

CREATE TABLE `tex_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `version` varchar(255) CHARACTER SET latin1 NOT NULL,
  `jpeg_quality` varchar(255) CHARACTER SET latin1 NOT NULL,
  `head` text NOT NULL,
  `foot` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tex_config` */

insert  into `tex_config`(`id`,`url`,`nombre`,`version`,`jpeg_quality`,`head`,`foot`) values (1,'http://localhost:8000/','LaTeXaMeN','0.5','95','\\documentclass[10pt]{article}\n\\usepackage{amsmath}\n\\usepackage[forpaper,pointsonboth,nototals,\nnosolutions,allowrandomize\n]{eqexam}\n\n\n\n\\usepackage{chemformula}\n\\usepackage[version=3]{mhchem}\n\\usepackage{varwidth}\n\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage[version=3]{mhchem}\n\\usepackage{booktabs}\n\\usepackage{paralist}\n\\usepackage{framed}\n\\usepackage{setspace}\n\\usepackage[spanish]{babel} \n\\usepackage[left=2.85cm,top=2.5cm,right=2.85cm,bottom=1.25cm]{geometry}\n\\usepackage{tikz}\n\\usepackage{pgfplots}\n\n\\spanishdecimal{,}\n%\\usepackage{times}\n%\\usepackage{newcent}\n%\\usepackage{palatino}\n%\\usepackage{bookman}\n\n\\pointLabel{punto}\n\\pointsLabel{puntos}\n\\ptLabel{pt.}            % singular form\n\\ptsLabel{{pts.}}\n\\eachLabel{\\tiny{apdo.}}\n\\renewcommand\\itemPTsTxt[1]{{\\footnotesize $#1$ pts}}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{document}\n\n\\vspace*{-2.7cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\small {Control-1 / 3º de ESO S}}}\\hfill {\\bf{\\small{Segunda Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\scriptsize{Diversidad de la materia\\ldots}}}\\hfill\\ {\\bf{\\scriptsize 17 de Junio de 2015}}}\\vspace{0,65cm}\n\\noindent \\makebox[1.05\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n\\vspace*{-1.5cm}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\makeatletter\n% \\eqemargin is the minimum distance to the left margin, plus \\marginparsep.\n% I\'ve removed \\marginparsep to get the minimal positioning. You can insert\n% additional spacing, such as 3pt+\\eqemargin\n\\renewcommand{\\eqleftmargin}[2]{\\makebox[0pt][r]{\\marginpointtext{#1}{#2}%\n    \\setlength{\\@tempdima}{\\eqemargin}%\n%    \\setlength{\\@tempdima}{\\marginparsep+\\eqemargin}%\n    \\hspace*{\\@tempdima}}}\n% important to execute this after the redefinition\n%\\PointsOnLeft\n\\makeatother\n\\lhead{}\n\\chead{}\n\\rhead{}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{exam}{Part1}\n\\forceNoColor\n%\\useFillerLines\n\\useFillerDefault\n%\\fillTypeHRule\n%\\fillTypeDefault\n%\\fillTypeDashLine\n\\fillTypeDots\n\\eqWriteLineColor{blue}\n\\eqWLSpacing{18pt}\n\\vspace*{1cm}\n\\begin{onehalfspace}','\\vfill\n\\hrule\n\\vspace*{0.2cm}\n\\noindent{\\footnotesize\\emph{{La puntuación total del examen es de \\summaryPointTotal\\ puntos.}}}\n\\end{onehalfspace}\n\\end{exam} \n\\end{document}\n\n');

/*Table structure for table `tex_exams` */

DROP TABLE IF EXISTS `tex_exams`;

CREATE TABLE `tex_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `problemas` varchar(255) NOT NULL,
  `preambulo` int(50) NOT NULL,
  `fecha` int(255) NOT NULL,
  `generado` int(50) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tex_exams` */

insert  into `tex_exams`(`id`,`titulo`,`problemas`,`preambulo`,`fecha`,`generado`) values (1,'Holaa','9,8',2,1439911362,1),(2,'testt2','2,1',1,1439911491,1),(3,'Prueba3','1,5,6',1,1439916133,0);

/*Table structure for table `tex_pre` */

DROP TABLE IF EXISTS `tex_pre`;

CREATE TABLE `tex_pre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `head` text NOT NULL,
  `foot` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tex_pre` */

insert  into `tex_pre`(`id`,`titulo`,`head`,`foot`) values (1,'Primero','\\documentclass[11pt]{article}\n\\usepackage[utf8]{inputenc}\n\\usepackage[spanish]{babel}\n\\usepackage{amsmath}\n\\usepackage{amsfonts}\n\\usepackage{amssymb}\n\\usepackage{graphicx}\n\\usepackage[left=2cm,top=2.5cm,right=2.5cm,bottom=1.5cm]{geometry}\n\\usepackage[version=3]{mhchem}\n\\usepackage{chemmacros}\n\\usepackage{chemformula}\n\\usepackage{chemfig}\n\\usepackage[load-headings=true]{exsheets}\n\\usepackage{enumitem}\n\\usepackage{marginnote}\n\\SetupExSheets{headings=margin-nr}\n\\SetupExSheets[points]{name=\\itshape\\scriptsize P,number-format=\\itshape\\scriptsize}\n\\usepackage{fancybox}\n%\\newcommand\\parens[1]{\\ovalbox{#1}}\n%\\SetupExSheets{points/format=\\parens}\n\\usepackage{marginnote}\n% define a new command \\subpoints that writes the points in a\n% \\marginnote; we defined it with a starred variant that only\n% will write but not add the points\n\\makeatletter\n\\newcommand*\\subpoints{\\@ifstar\\subpoints@star\\subpoints@nostar}\n\\newcommand*\\subpoints@star[1]{\\marginnote{\\points{#1}}}\n\\newcommand*\\subpoints@nostar[1]{\\marginnote{\\addpoints{#1}}}\n\n\\renewcommand{\\arraystretch}{0.8}\n\n\\makeatother\n%\\DebugExSheets{true}    %Asi muestro los ID de las preguntas de este examen\n%Paginas sin numeracion (plain para numeracion)\n\\pagestyle{empty}\n%\\parindent=0mm\n%Encabezados tipo de numeracion etc.\n\\SetupExSheets{headings=margin-nr}\n    \\SetupExSheets[points]{name=\\itshape\\scriptsize Pt.,number-format=\\itshape\\scriptsize}\n\\SetupExSheets[points]{name-plural=\\itshape\\scriptsize Pts.,number-format=\\itshape\\scriptsize}\n\n\\newcommand \\cp[1]{%\n \\marginnote{\\begin{tabular}{|c|}\n  \\hline\\\\\\\\\n  \\hline\n {\\textbf{\\points{#1}}}\\\\\n \\hline\n\\end{tabular}}}\n\n\n\n\n\\ExplSyntaxOn\n\\cs_set_nopar:Npn \\exsheets_points_name:n #1\n {\n   \\bool_if:NT \\l__exsheets_points_name_bool\n     {\n       \\,\n       \\hbox:n\n         {\n           \\bool_if:NTF \\l__exsheets_parse_points_bool\n             {\n               \\tl_if_eq:nnTF {#1} { ?? }\n                 { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n                 {\n                   \\fp_compare:nTF { #1 =  1 }\n                     { \\tl_use:N \\l__exsheets_points_name_tl }\n                     { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n                 }\n             }\n             { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n         }\n     }\n }\n\\ExplSyntaxOff\n\n\\begin{document}\n\n%una linea\n\\vspace*{-3cm}\\noindent\\rule{1,12\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1,12\\linewidth]{{\\bf{\\footnotesize {Control-1/2º Bachillerato S}}}\\hfill {\\bf{\\footnotesize{Primera Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1,12\\linewidth]{{\\bf{\\tiny{Química Básica.}}}\\hfill\\ {\\bf{\\tiny{4 de Noviembre de 2012}}}}\\vspace{0,5cm}\n\\noindent \\makebox[1,12\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1,12\\textwidth}{0,4pt}\n','\\vfill\n\\hrule\n\\vspace*{2mm}\n{\\sc \\footnotesize Tabla de puntuaciones\\\\}{\\tiny \\begin{center}\n\\SetupExSheets{\n points/number-format= ,\n counter-format=qu\n}\n\\renewcommand{\\arraystretch}{2.2}\n\\begin{tabular}{|l|*{\\numberofquestions}{p{0.8cm}|}c|}\\hline\n Pregunta     &\n\\ForEachQuestion{\\centering{\\QuestionNumber{#1}}\\iflastquestion{}{&}} & Total \\\\ \\hline\n Puntuaci\\\'on & \\\n\\ForEachQuestion{\\centering{\\GetQuestionProperty{points}{#1}}\\iflastquestion{}{&}} &\n\\pointssum* \\\\ \\hline\nObtenido  & \\ForEachQuestion{\\iflastquestion{}{&}} & \\\\ \n\\hline\n\\end{tabular}\n\n\\end{center}\n\\end{document}'),(2,'Segundo','\\documentclass[10pt]{article}\n\\usepackage{amsmath}\n\\usepackage[forpaper,pointsonboth,nototals,\nnosolutions,allowrandomize\n]{eqexam}\n\n\n\n\\usepackage{chemformula}\n\\usepackage[version=3]{mhchem}\n\\usepackage{varwidth}\n\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage[version=3]{mhchem}\n\\usepackage{booktabs}\n\\usepackage{paralist}\n\\usepackage{framed}\n\\usepackage{setspace}\n\\usepackage[spanish]{babel} \n\\usepackage[left=2.85cm,top=2.5cm,right=2.85cm,bottom=1.25cm]{geometry}\n\\usepackage{tikz}\n\\usepackage{pgfplots}\n\n\\spanishdecimal{,}\n%\\usepackage{times}\n%\\usepackage{newcent}\n%\\usepackage{palatino}\n%\\usepackage{bookman}\n\n\\pointLabel{punto}\n\\pointsLabel{puntos}\n\\ptLabel{pt.}            % singular form\n\\ptsLabel{{pts.}}\n\\eachLabel{\\tiny{apdo.}}\n\\renewcommand\\itemPTsTxt[1]{{\\footnotesize $#1$ pts}}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{document}\n\n\\vspace*{-2.7cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\small {Control-1 / 3º de ESO S}}}\\hfill {\\bf{\\small{Segunda Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\scriptsize{Diversidad de la materia\\ldots}}}\\hfill\\ {\\bf{\\scriptsize 17 de Junio de 2015}}}\\vspace{0,65cm}\n\\noindent \\makebox[1.05\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n\\vspace*{-1.5cm}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\makeatletter\n% \\eqemargin is the minimum distance to the left margin, plus \\marginparsep.\n% I\'ve removed \\marginparsep to get the minimal positioning. You can insert\n% additional spacing, such as 3pt+\\eqemargin\n\\renewcommand{\\eqleftmargin}[2]{\\makebox[0pt][r]{\\marginpointtext{#1}{#2}%\n    \\setlength{\\@tempdima}{\\eqemargin}%\n%    \\setlength{\\@tempdima}{\\marginparsep+\\eqemargin}%\n    \\hspace*{\\@tempdima}}}\n% important to execute this after the redefinition\n%\\PointsOnLeft\n\\makeatother\n\\lhead{}\n\\chead{}\n\\rhead{}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{exam}{Part1}\n\\forceNoColor\n%\\useFillerLines\n\\useFillerDefault\n%\\fillTypeHRule\n%\\fillTypeDefault\n%\\fillTypeDashLine\n\\fillTypeDots\n\\eqWriteLineColor{blue}\n\\eqWLSpacing{18pt}\n\\vspace*{1cm}\n\\begin{onehalfspace}','\\vfill\n\\hrule\n\\vspace*{0.2cm}\n\\noindent{\\footnotesize\\emph{{La puntuación total del examen es de \\summaryPointTotal\\ puntos.}}}\n\\end{onehalfspace}\n\\end{exam} \n\\end{document}\n\n');

/*Table structure for table `tex_problemas` */

DROP TABLE IF EXISTS `tex_problemas`;

CREATE TABLE `tex_problemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `latex` text NOT NULL,
  `preview` varchar(254) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tex_problemas` */

insert  into `tex_problemas`(`id`,`titulo`,`data`,`latex`,`preview`) values (1,'sulfuricovaloradoBeOH2-1','{\"Tags\":\"Disoluciones, concentracion, fracción molar, diluciones, neutralización. EX-1pto-2013-14\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-alta\"}','%@ Titre: sulfuricovaloradoBeOH2-1\n%@ Domaine: Química Básica\n%@ Chapitre: Composición, cantidades en química.\n%@ Dificultad: Media-alta\n%@ Observaciones: Disoluciones, concentracion, fracción molar, diluciones, neutralización. EX-1pto-2013-14\n%@ Identificador: 00062\n\n\\begin{question}{0.5}\nSe disuelven 50 g de ácido sulfúrico (\\ce{H2SO4}) en 200 g de agua resultando una disolución de densidad 1.12 $\\frac{g}{cm^3}$.\nCalcula la molaridad de la disolución que resulta al mezclar 50 {m\\it l} de la disolución anterior con 120 ${cm^3}$ de una disolución 0.5 M de \\ce{H2SO4}. Considera los volúmenes aditivos.\n\\end{question}\n\\begin{solution}\n\\end{solution}','1'),(2,'combustionpropano-1','{\"Tags\":\"Examen, Estequiometría, rendimiento, combustión\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-alta\"}','%@ Titre: combustionpropano-1\n%@ Domaine: Química Básica\n%@ Chapitre: Composición, cantidades en química.\n%@ Dificultad: Media-alta\n%@ Observaciones: Examen, Estequiometría, rendimiento, combustión\n%@ Identificador: 00081\n\n\\begin{question}{0.5}\nSe hacen reaccionar 20.0 g de propano (\\ce{C3H8}) con 50.0 g de \\ce{O2}.\nDetermina el volumen de oxígeno, medido en condiciones normales, que se necesitará para obtener 28.8 g de agua sabiendo que el rendimiento de la reacción es del 80 \\%.\n\\end{question}\n\\begin{solution}\n\\end{solution}\n','1'),(5,'Separacion','{\"Tags\":\"Separar\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','%\\ID{q1002151041}\n\\begin{problem}[10]\nCómo separarías en el laboratorio una mezcla formada por arena, sal y limaduras de hierro.\n\n\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem}\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%','1'),(6,'Heterogéneos u homogéneos','{\"Tags\":\"Heterogéneos, homogéneos\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','\\vspace*{-0.5cm}\n\\begin{problem*}[2ea]\nDe los siguientes sistemas materiales indica cuales son heterogéneos u homogéneos, entre los últimos cuáles son disoluciones o sustancias puras, y a su vez de éstos distingue entre elementos y compuestos.\n\\begin{multicols}{2} \n	 \\begin{parts}\n		\\item Agua salada.\\dotfill \\par\n		 \\dotfill\n		\\item Vinagre.\\dotfill \\par\n		 \\dotfill\n		\\item Nitrógeno (\\ce{N2}).\\dotfill \\par\n		 \\dotfill\n		\\item Aire.\\dotfill \\par\n		 \\dotfill\n		\\item Acero.\\dotfill \\par\n		 \\dotfill\n		\\item Cobre.\\dotfill \\par\n		 \\dotfill\n		\\item Ácido sulfúrico (\\ce{HSO4}).\\dotfill \\par\n		 \\dotfill\n		\\item Arena con grava.\\dotfill \\par\n		 \\dotfill\n\\end{parts}\n	\\end{multicols} \n\\end{problem*}\n\\vspace*{-0.75cm}\n%%%%%%\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%','1'),(7,'Mezcla','{\"Tags\":\"Mezcla\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','%\\ID{q1002151017}\n\\begin{problem*}[\\auto]\nSe mezclan 60 g de agua con 2 g de NaCl.\n	\\begin{parts}\n		\\item \\PTs{4} ?`Cuáles son el soluto y el disolvente? Razona la respuesta\\dotfill \\par \\dotfill\\par \\dotfill\n		\\item \\PTs{12} Calcula el tanto por ciento en masa.\n\n\\begin{solution}[4cm]\n\\phantom{}\n\\end{solution}\n\\begin{workarea}{\\sameVspace}\n\\fbox{\\parbox[t][\\sameVspace-2\\fboxsep-2\\fboxrule]{\\linewidth-2\\fboxsep-2\\fboxrule}{\\vfill\\hfill}}\n\\end{workarea}\n		    \\end{parts}\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem*}\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%','1'),(8,'Disolucion','{\"Tags\":\"Disolucion\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-Baja\"}','%\\ID{fq1002154010}\n\\begin{problem*}[\\auto]Se tiene una disolución acuosa de KI de concentración $8 \\frac{g}{{\\it l}}$. Contesta a las siguientes preguntas:\n	\\begin{parts}\n	\\item \\PTs{4}¿Quienes son soluto y disolvente? Razona.\n	\\item \\PTs{10}Calcula la masa de KI presente en 200 ${cm^3}$ de esa disolución.\n\\end{parts}\n\\begin{solution}[2cm]\n\\phantom{}\n\\end{solution}\n\\begin{workarea}{\\sameVspace}\n\\fbox{\\parbox[t][\\sameVspace-2\\fboxsep-2\\fboxrule]{\\linewidth-2\\fboxsep-2\\fboxrule}{\\vfill\\hfill}}\n\\end{workarea}\n\\end{problem*}','1'),(9,'Partículas subatómicas','{\"Tags\":\"Partículas, subatómicas\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','\\begin{problem}[15]Explica {\\bf lo más detalladamente posible} qué partículas subatómicas conoces y cuáles son sus características más importantes (ubicación, carga y masa)?\n\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\n\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem}','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
