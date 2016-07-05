/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.14-log : Database - latexamen
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tex_1_exams` */

DROP TABLE IF EXISTS `tex_1_exams`;

CREATE TABLE `tex_1_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `problemas` varchar(255) NOT NULL,
  `preambulo` int(50) NOT NULL,
  `fecha` int(255) NOT NULL,
  `generado` int(50) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tex_1_exams` */

insert  into `tex_1_exams`(`id`,`titulo`,`problemas`,`preambulo`,`fecha`,`generado`) values (1,'Holaa','9,8',2,1439911362,1),(2,'testt2','2,1',1,1439911491,1),(3,'Prueba3','1,5,6',1,1439916133,0),(4,'Prueba','10,11,12,13',3,1467644949,1);

/*Table structure for table `tex_1_pre` */

DROP TABLE IF EXISTS `tex_1_pre`;

CREATE TABLE `tex_1_pre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `head` text NOT NULL,
  `foot` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tex_1_pre` */

insert  into `tex_1_pre`(`id`,`titulo`,`head`,`foot`) values (1,'Primero','\\documentclass[11pt]{article}\n\\usepackage[utf8]{inputenc}\n\\usepackage[spanish]{babel}\n\\usepackage{amsmath}\n\\usepackage{amsfonts}\n\\usepackage{amssymb}\n\\usepackage{graphicx}\n\\usepackage[left=2cm,top=2.5cm,right=2.5cm,bottom=1.5cm]{geometry}\n\\usepackage[version=3]{mhchem}\n\\usepackage{chemmacros}\n\\usepackage{chemformula}\n\\usepackage{chemfig}\n\\usepackage[load-headings=true]{exsheets}\n\\usepackage{enumitem}\n\\usepackage{marginnote}\n\\SetupExSheets{headings=margin-nr}\n\\SetupExSheets[points]{name=\\itshape\\scriptsize P,number-format=\\itshape\\scriptsize}\n\\usepackage{fancybox}\n%\\newcommand\\parens[1]{\\ovalbox{#1}}\n%\\SetupExSheets{points/format=\\parens}\n\\usepackage{marginnote}\n% define a new command \\subpoints that writes the points in a\n% \\marginnote; we defined it with a starred variant that only\n% will write but not add the points\n\\makeatletter\n\\newcommand*\\subpoints{\\@ifstar\\subpoints@star\\subpoints@nostar}\n\\newcommand*\\subpoints@star[1]{\\marginnote{\\points{#1}}}\n\\newcommand*\\subpoints@nostar[1]{\\marginnote{\\addpoints{#1}}}\n\n\\renewcommand{\\arraystretch}{0.8}\n\n\\makeatother\n%\\DebugExSheets{true}    %Asi muestro los ID de las preguntas de este examen\n%Paginas sin numeracion (plain para numeracion)\n\\pagestyle{empty}\n%\\parindent=0mm\n%Encabezados tipo de numeracion etc.\n\\SetupExSheets{headings=margin-nr}\n    \\SetupExSheets[points]{name=\\itshape\\scriptsize Pt.,number-format=\\itshape\\scriptsize}\n\\SetupExSheets[points]{name-plural=\\itshape\\scriptsize Pts.,number-format=\\itshape\\scriptsize}\n\n\\newcommand \\cp[1]{%\n \\marginnote{\\begin{tabular}{|c|}\n  \\hline\\\\\\\\\n  \\hline\n {\\textbf{\\points{#1}}}\\\\\n \\hline\n\\end{tabular}}}\n\n\n\n\n\\ExplSyntaxOn\n\\cs_set_nopar:Npn \\exsheets_points_name:n #1\n {\n   \\bool_if:NT \\l__exsheets_points_name_bool\n     {\n       \\,\n       \\hbox:n\n         {\n           \\bool_if:NTF \\l__exsheets_parse_points_bool\n             {\n               \\tl_if_eq:nnTF {#1} { ?? }\n                 { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n                 {\n                   \\fp_compare:nTF { #1 =  1 }\n                     { \\tl_use:N \\l__exsheets_points_name_tl }\n                     { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n                 }\n             }\n             { \\tl_use:N \\l__exsheets_points_name_plural_tl }\n         }\n     }\n }\n\\ExplSyntaxOff\n\n\\begin{document}\n\n%una linea\n\\vspace*{-3cm}\\noindent\\rule{1,12\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1,12\\linewidth]{{\\bf{\\footnotesize {Control-1/2º Bachillerato S}}}\\hfill {\\bf{\\footnotesize{Primera Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1,12\\linewidth]{{\\bf{\\tiny{Química Básica.}}}\\hfill\\ {\\bf{\\tiny{4 de Noviembre de 2012}}}}\\vspace{0,5cm}\n\\noindent \\makebox[1,12\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1,12\\textwidth}{0,4pt}\n','\\vfill\n\\hrule\n\\vspace*{2mm}\n{\\sc \\footnotesize Tabla de puntuaciones\\\\}{\\tiny \\begin{center}\n\\SetupExSheets{\n points/number-format= ,\n counter-format=qu\n}\n\\renewcommand{\\arraystretch}{2.2}\n\\begin{tabular}{|l|*{\\numberofquestions}{p{0.8cm}|}c|}\\hline\n Pregunta     &\n\\ForEachQuestion{\\centering{\\QuestionNumber{#1}}\\iflastquestion{}{&}} & Total \\\\ \\hline\n Puntuaci\\\'on & \\\n\\ForEachQuestion{\\centering{\\GetQuestionProperty{points}{#1}}\\iflastquestion{}{&}} &\n\\pointssum* \\\\ \\hline\nObtenido  & \\ForEachQuestion{\\iflastquestion{}{&}} & \\\\ \n\\hline\n\\end{tabular}\n\n\\end{center}\n\\end{document}'),(2,'Segundo','\\documentclass[10pt]{article}\n\\usepackage{amsmath}\n\\usepackage[forpaper,pointsonboth,nototals,\nnosolutions,allowrandomize\n]{eqexam}\n\n\n\n\\usepackage{chemformula}\n\\usepackage[version=3]{mhchem}\n\\usepackage{varwidth}\n\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage[version=3]{mhchem}\n\\usepackage{booktabs}\n\\usepackage{paralist}\n\\usepackage{framed}\n\\usepackage{setspace}\n\\usepackage[spanish]{babel} \n\\usepackage[left=2.85cm,top=2.5cm,right=2.85cm,bottom=1.25cm]{geometry}\n\\usepackage{tikz}\n\\usepackage{pgfplots}\n\n\\spanishdecimal{,}\n%\\usepackage{times}\n%\\usepackage{newcent}\n%\\usepackage{palatino}\n%\\usepackage{bookman}\n\n\\pointLabel{punto}\n\\pointsLabel{puntos}\n\\ptLabel{pt.}            % singular form\n\\ptsLabel{{pts.}}\n\\eachLabel{\\tiny{apdo.}}\n\\renewcommand\\itemPTsTxt[1]{{\\footnotesize $#1$ pts}}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{document}\n\n\\vspace*{-2.7cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\small {Control-1 / 3º de ESO S}}}\\hfill {\\bf{\\small{Segunda Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\scriptsize{Diversidad de la materia\\ldots}}}\\hfill\\ {\\bf{\\scriptsize 17 de Junio de 2015}}}\\vspace{0,65cm}\n\\noindent \\makebox[1.05\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n\\vspace*{-1.5cm}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\makeatletter\n% \\eqemargin is the minimum distance to the left margin, plus \\marginparsep.\n% I\'ve removed \\marginparsep to get the minimal positioning. You can insert\n% additional spacing, such as 3pt+\\eqemargin\n\\renewcommand{\\eqleftmargin}[2]{\\makebox[0pt][r]{\\marginpointtext{#1}{#2}%\n    \\setlength{\\@tempdima}{\\eqemargin}%\n%    \\setlength{\\@tempdima}{\\marginparsep+\\eqemargin}%\n    \\hspace*{\\@tempdima}}}\n% important to execute this after the redefinition\n%\\PointsOnLeft\n\\makeatother\n\\lhead{}\n\\chead{}\n\\rhead{}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{exam}{Part1}\n\\forceNoColor\n%\\useFillerLines\n\\useFillerDefault\n%\\fillTypeHRule\n%\\fillTypeDefault\n%\\fillTypeDashLine\n\\fillTypeDots\n\\eqWriteLineColor{blue}\n\\eqWLSpacing{18pt}\n\\vspace*{1cm}\n\\begin{onehalfspace}','\\vfill\n\\hrule\n\\vspace*{0.2cm}\n\\noindent{\\footnotesize\\emph{{La puntuación total del examen es de \\summaryPointTotal\\ puntos.}}}\n\\end{onehalfspace}\n\\end{exam} \n\\end{document}\n\n'),(3,'Tercero','%:\n\\documentclass[9pt]{scrartcl}\n\\usepackage{amsmath}\n\\usepackage[forpaper,nopopontsals,nosolutions]{eqexam}\n\\usepackage{chemformula}\n\\usepackage[version=4]{mhchem}\n\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage{booktabs}\n\\usepackage{setspace}\n\\usepackage[spanish]{babel} \n\\usepackage[left=2cm,top=0.35cm,right=2.5cm,bottom=1cm]{geometry}\n\\usepackage{varwidth}\n\\spanishdecimal{,}\n\\pointLabel{punto}\n\\pointsLabel{puntos}\n\\ptLabel{pt.}            % singular form\n\\ptsLabel{{pts.}}\n\\eachLabel{\\tiny{apdo.}}\n\\renewcommand\\itemPTsTxt[1]{{\\footnotesize $#1$ pts}}\n\\usepackage[version-1-compatibility]{siunitx}\n%\\usepackage{times}\n%\\usepackage{newcent}\n\\usepackage{palatino}\n%\\usepackage{bookman}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n% %%                    zona de unidades                 %%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\usepackage{siunitx}\n\\sisetup{inter-unit-product = \\ensuremath{{}\\cdot{}}}\n\\sisetup{quotient-mode=fraction}\n\\sisetup{per-mode=fraction}\n\\sisetup{exponent-product=\\cdot}\n\\sisetup{output-decimal-marker={,}}\n\n %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{document}\n\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\footnotesize {Examen -- 3 / 1º Bachillerato}}}\\hfill {\\bf{\\footnotesize{Tercera Evaluación}}}}\n\\vspace{-0,35cm}\n\\noindent\\makebox[1.05\\linewidth]{{\\scriptsize{Examen Unidades formativas 6 y 7. Cinemática y Dinámica.}}\\hfill\\ {{\\scriptsize{16 de junio de 2016}}}}\\vspace{0,65cm}\n\\noindent \\makebox[1.05\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\makeatletter\n% \\eqemargin is the minimum distance to the left margin, plus \\marginparsep.\n% I\'ve removed \\marginparsep to get the minimal positioning. You can insert\n% additional spacing, such as 3pt+\\eqemargin\n\\renewcommand{\\eqleftmargin}[2]{\\makebox[0pt][r]{\\marginpointtext{#1}{#2}%\n    \\setlength{\\@tempdima}{\\eqemargin}%\n%    \\setlength{\\@tempdima}{\\marginparsep+\\eqemargin}%\n    \\hspace*{\\@tempdima}}}\n% important to execute this after the redefinition\n%\\PointsOnLeft\n\\makeatother\n\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{exam}{Part1}\n\\begin{onehalfspace}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  ','\\hrule\n\\end{onehalfspace}\n\\end{exam} \n\\end{document}\n');

/*Table structure for table `tex_1_problemas` */

DROP TABLE IF EXISTS `tex_1_problemas`;

CREATE TABLE `tex_1_problemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `estandares` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `latex` text NOT NULL,
  `preview` varchar(254) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `tex_1_problemas` */

insert  into `tex_1_problemas`(`id`,`titulo`,`estandares`,`data`,`latex`,`preview`) values (1,'sulfuricovaloradoBeOH2-1','-1','{\"Tags\":\"Disoluciones, concentracion, fracción molar, diluciones, neutralización\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-alta\"}','%@ Titre: sulfuricovaloradoBeOH2-1\n%@ Domaine: Química Básica\n%@ Chapitre: Composición, cantidades en química.\n%@ Dificultad: Media-alta\n%@ Observaciones: Disoluciones, concentracion, fracción molar, diluciones, neutralización. EX-1pto-2013-14\n%@ Identificador: 00062\n\n\\begin{question}{0.5}\nSe disuelven 50 g de ácido sulfúrico (\\ce{H2SO4}) en 200 g de agua resultando una disolución de densidad 1.12 $\\frac{g}{cm^3}$.\nCalcula la molaridad de la disolución que resulta al mezclar 50 {m\\it l} de la disolución anterior con 120 ${cm^3}$ de una disolución 0.5 M de \\ce{H2SO4}. Considera los volúmenes aditivos.\n\\end{question}\n\\begin{solution}\n\\end{solution}','0'),(2,'combustionpropano-1','-1','{\"Tags\":\"Examen, Estequiometría, rendimiento, combustión\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-alta\"}','%@ Titre: combustionpropano-1\n%@ Domaine: Química Básica\n%@ Chapitre: Composición, cantidades en química.\n%@ Dificultad: Media-alta\n%@ Observaciones: Examen, Estequiometría, rendimiento, combustión\n%@ Identificador: 00081\n\n\\begin{question}{0.5}\nSe hacen reaccionar 20.0 g de propano (\\ce{C3H8}) con 50.0 g de \\ce{O2}.\nDetermina el volumen de oxígeno, medido en condiciones normales, que se necesitará para obtener 28.8 g de agua sabiendo que el rendimiento de la reacción es del 80 \\%.\n\\end{question}\n\\begin{solution}\n\\end{solution}\n','1'),(5,'Separacion','B1.1.2','{\"Tags\":\"Separar\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','%\\ID{q1002151041}\n\\begin{problem}[10]\nCómo separarías en el laboratorio una mezcla formada por arena, sal y limaduras de hierro.\n\n\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem}\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%','1'),(6,'Heterogéneos u homogéneos','B2.2.3','{\"Tags\":\"Heterogéneos, homogéneos\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','\\vspace*{-0.5cm}\n\\begin{problem*}[2ea]\nDe los siguientes sistemas materiales indica cuales son heterogéneos u homogéneos, entre los últimos cuáles son disoluciones o sustancias puras, y a su vez de éstos distingue entre elementos y compuestos.\n\\begin{multicols}{2} \n	 \\begin{parts}\n		\\item Agua salada.\\dotfill \\par\n		 \\dotfill\n		\\item Vinagre.\\dotfill \\par\n		 \\dotfill\n		\\item Nitrógeno (\\ce{N2}).\\dotfill \\par\n		 \\dotfill\n		\\item Aire.\\dotfill \\par\n		 \\dotfill\n		\\item Acero.\\dotfill \\par\n		 \\dotfill\n		\\item Cobre.\\dotfill \\par\n		 \\dotfill\n		\\item Ácido sulfúrico (\\ce{HSO4}).\\dotfill \\par\n		 \\dotfill\n		\\item Arena con grava.\\dotfill \\par\n		 \\dotfill\n\\end{parts}\n	\\end{multicols} \n\\end{problem*}\n\\vspace*{-0.75cm}\n%%%%%%\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%','1'),(7,'Mezcla','B2.3.1','{\"Tags\":\"Mezcla\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','%\\ID{q1002151017}\n\\begin{problem*}[\\auto]\nSe mezclan 60 g de agua con 2 g de NaCl.\n	\\begin{parts}\n		\\item \\PTs{4} ?`Cuáles son el soluto y el disolvente? Razona la respuesta\\dotfill \\par \\dotfill\\par \\dotfill\n		\\item \\PTs{12} Calcula el tanto por ciento en masa.\n\n\\begin{solution}[4cm]\n\\phantom{}\n\\end{solution}\n\\begin{workarea}{\\sameVspace}\n\\fbox{\\parbox[t][\\sameVspace-2\\fboxsep-2\\fboxrule]{\\linewidth-2\\fboxsep-2\\fboxrule}{\\vfill\\hfill}}\n\\end{workarea}\n		    \\end{parts}\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem*}\n%\\endID\n%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%','1'),(8,'Disolucion','-1','{\"Tags\":\"Disolucion\",\"Area\":\"Química Básica\",\"Dificultad\":\"Media-Baja\"}','%\\ID{fq1002154010}\n\\begin{problem*}[\\auto]Se tiene una disolución acuosa de KI de concentración $8 \\frac{g}{{\\it l}}$. Contesta a las siguientes preguntas:\n	\\begin{parts}\n	\\item \\PTs{4}¿Quienes son soluto y disolvente? Razona.\n	\\item \\PTs{10}Calcula la masa de KI presente en 200 ${cm^3}$ de esa disolución.\n\\end{parts}\n\\begin{solution}[2cm]\n\\phantom{}\n\\end{solution}\n\\begin{workarea}{\\sameVspace}\n\\fbox{\\parbox[t][\\sameVspace-2\\fboxsep-2\\fboxrule]{\\linewidth-2\\fboxsep-2\\fboxrule}{\\vfill\\hfill}}\n\\end{workarea}\n\\end{problem*}','1'),(9,'Partículas subatómicas','B2.5.1 B2.5.2','{\"Tags\":\"Partículas, subatómicas\",\"Area\":\"Química Básica\",\"Dificultad\":\"Facil\"}','\\begin{problem}[15]Explica {\\bf lo más detalladamente posible} qué partículas subatómicas conoces y cuáles son sus características más importantes (ubicación, carga y masa)?\n\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\\par\\dotfill\n\n\\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem}','1'),(10,'test1','B6.2.1 B6.3.1 B6.6.1','{\"Tags\":\"-1\",\"Area\":\"-1\",\"Dificultad\":\"-1\"}','\\begin{problem*}[\\auto]La ecuación del movimiento para un objeto puntual viene dada por su vector de posición:\\\\  \\,$\\vec{r}(t)=4\\,t \\ \\vec{i} + (5\\,t^2 -8)\\ \\vec{j}$ \\, en unidades del S.I.:\n\\begin{parts}\n\\item \\PTs{10} La celeridad en el instante t = 3 s.\n\\item Determina el vector aceleración instantánea.\n\\item \\, \\PTs{5} \\,Calcula el módulo de sus aceleraciones tangencial y centrípeta.\n\\end{parts}\n \\begin{solution}\n\\phantom{}\n\\end{solution}\n\\end{problem*}','1'),(11,'test2','B6.5.1 B6.8.1','{\"Tags\":\"-1\",\"Area\":\"-1\",\"Dificultad\":\"-1\"}','\\begin{problem*}[10ea]\nUn arquero quiere efectuar un tiro parabólico entre dos acantilados separados 25 m. El acantilado de la izquierda, donde se encuentra el arquero se halla 4 m por encima del de la derecha. Si el arquero sólo puede disparar con un ángulo de 30º y quiere lanzar las flechas 5 m más allá del borde del acantilado de la derecha: \n\\begin{parts}\n\\item Calcula el tiempo de vuelo. \n\\item Calcula con qué velocidad mínima ha de lanzarlas.\n\\end{parts}\n\\end{problem*}','1'),(12,'test3','B6.9.2 B6.9.3 B6.9.4 B6.9.5','{\"Tags\":\"-1\",\"Area\":\"-1\",\"Dificultad\":\"-1\"}','\\begin{problem*}[10ea]Un cuerpo que oscila con una amplitud de $0.1$ m tarda\nmedio segundo en ir de la posición de equilibrio a la de máxima elongación,\nen la que se encuentra en el instante t= 2 s. Calcula:\n\\begin{parts}\n\\item El período y la pulsación (frecuencia angular).\n\\item La ecuación del movimiento.\n\\item ¿En qué instantes será máxima su velocidad?\n\\end{parts}\n\\end{problem*}','1'),(13,'test4','B7.1.1 B7.2.2 B7.2.3','{\"Tags\":\"-1\",\"Area\":\"-1\",\"Dificultad\":\"-1\"}',' \\begin{problem*}[10ea] \nEl coeficiente de rozamiento entre $m_1$ y el plano sobre el que desliza es de $\\mu=0.3$ y calcula: \\\\\n\\begin{minipage}{\\linewidth}\n\\begin{varwidth}{0.5\\linewidth}\n\\includegraphics[scale=0.4]{grafico5.jpg}\n\\end{varwidth}\\hfill\n\\begin{varwidth}{0.5\\linewidth}\n\\begin{parts}\n\\item  Representa las fuerzas implicadas en cada una de las masas.\n\\item ¿Cuánto debe valer $m_1$, si en 2 s ha recorrido 2 m sobre el plano?\n\\item Calcula las tensiones de las cuerdas.\n\\end{parts}\n\\end{varwidth}\n\\end{minipage}\n\\end{problem*}','1');

/*Table structure for table `tex_1_standards` */

DROP TABLE IF EXISTS `tex_1_standards`;

CREATE TABLE `tex_1_standards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estandar` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `puntuacion` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

/*Data for the table `tex_1_standards` */

insert  into `tex_1_standards`(`id`,`estandar`,`descripcion`,`puntuacion`) values (1,'B1.1.2','Resuelve ejercicios numéricos expresando el valor de las magnitudes empleando la notación científica, estima los errores absoluto y relativo asociados y contextualiza los resultados.',10),(2,'B1.1.3','Efectúa el análisis dimensional de las ecuaciones que relacionan las diferentes magnitudes en un proceso físico o químico.',10),(3,'B1.1.4','Distingue entre magnitudes escalares y vectoriales y opera adecuadamente con ellas.',15),(4,'B2.1.1','Justifica la teoría atómica de Dalton y la discontinuidad de la materia a partir de las leyes fundamentales de la Química ejemplificándolo con reacciones.',15),(5,'B2.2.1','Determina las magnitudes que definen el estado de un gas aplicando la ecuación de estado de los gases ideales.',30),(6,'B2.2.3','Determina presiones totales y parciales de los gases de una mezcla relacionando la presión total de un sistema con la fracción molar y la ecuación de estado de los gases ideales.',10),(7,'B2.3.1','Relaciona la fórmula empírica y molecular de un compuesto con su composición centesimal aplicando la ecuación de estado de los gases ideales.',10),(8,'B2.4.1',' Expresa la concentración de una disolución en g/l, mol/l % en peso y % en volumen. Describe el procedimiento de preparación en el laboratorio, de disoluciones de una concentración determinada y realiza los cálculos necesarios, tanto para el caso de solutos en estado sólido como a partir de otra de concentración conocida.',5),(9,'B2.5.1','Interpreta la variación de las temperaturas de fusión y ebullición de un líquido al que se le añade un soluto relacionándolo con algún proceso de interés en nuestro entorno.',10),(10,'B2.5.2','Utiliza el concepto de presión osmótica para describir el paso de iones a través de una membrana semipermeable.',10),(11,'B2.6.1','Calcula la masa atómica de un elemento a partir de los datos espectrométricos obtenidos para los diferentes isótopos del mismo.',15),(12,'B3.1.1','Escribe y ajusta ecuaciones químicas sencillas de distinto tipo (neutralización, oxidación, síntesis) y de interés bioquímico o industrial.',30),(13,'B3.2.1',' Interpreta una ecuación química en términos de cantidad de materia, masa, número de partículas o volumen para realizar cálculos estequiométricos en la misma.',15),(14,'B3.2.2',' Realiza los cálculos estequiométricos aplicando la ley de conservación de la masa a distintas reacciones.',15),(15,'B3.2.3','Efectúa cálculos estequiométricos en los que intervengan compuestos en estado sólido, líquido o gaseoso, o en disolución en presencia de un reactivo limitante o un reactivo impuro.',5),(16,'B3.2.4','Considera el rendimiento de una reacción en la realización de cálculos estequiométricos.',10),(17,'B4.1.1','Relaciona la variación de la energía interna en un proceso termodinámico con el calor absorbido o desprendido y el trabajo realizado en el proceso.',30),(18,'B4.2.1','Explica razonadamente el procedimiento para determinar el equivalente mecánico del calor tomando como referente aplicaciones virtuales interactivas asociadas al experimento de Joule.',10),(19,'B4.3.1',' Expresa las reacciones mediante ecuaciones termoquímicas dibujando e interpretando los diagramas entálpicos asociados.',20),(20,'B4.4.1',' Calcula la variación de entalpía de una reacción aplicando la ley de Hess, conociendo las entalpías de formación o las energías de enlace asociadas a una transformación química dada e interpreta su signo.',30),(21,'B4.5.1','Predice la variación de entropía en una reacción química dependiendo de la molecularidad y estado de los compuestos que intervienen.',2),(22,'B4.6.1','Identifica la energía de Gibbs con la magnitud que informa sobre la espontaneidad de una reacción química.',2),(23,'B4.6.2','Justifica la espontaneidad de una reacción química en función de los factores entálpicos entrópicos y de la temperatura.',5),(24,'B4.7.1','Plantea situaciones reales o figuradas en que se pone de manifiesto el segundo principio de la termodinámica, asociando el concepto de entropía con la irreversibilidad de un proceso.',30),(25,'B4.7.2','Relaciona el concepto de entropía con la espontaneidad de los procesos irreversibles.',30),(26,'B4.8.1','A partir de distintas fuentes de información, analiza las consecuencias del uso de combustibles fósiles, relacionando las emisiones de CO2, con su efecto en la calidad de vida, el efecto invernadero, el calentamiento global, la reducción de los recursos naturales, y otros y propone actitudes sostenibles para minorar estos efectos.',10),(27,'B5.1.1','Formula y nombra según las normas de la IUPAC: hidrocarburos de cadena abierta y cerrada y derivados aromáticos.',10),(28,'B5.2.1','Formula y nombra según las normas de la IUPAC: compuestos orgánicos sencillos con una función oxigenada o nitrogenada.',10),(29,'B5.3.1','Representa los diferentes isómeros de un compuesto orgánico.',10),(30,'B6.2.1',' Describe el movimiento de un cuerpo a partir de sus vectores de posición, velocidad y aceleración en un sistema de referencia dado.',10),(31,'B6.3.1','Obtiene las ecuaciones que describen la velocidad y la aceleración de un cuerpo a partir de la expresión del vector de posición en función del tiempo.',10),(32,'B6.3.2','Resuelve ejercicios prácticos de cinemática en dos dimensiones (movimiento de un cuerpo en un plano) aplicando las ecuaciones de los movimientos rectilíneo uniforme (M.R.U) y movimiento rectilíneo uniformemente acelerado (M.R.U.A.).',20),(33,'B6.4.1','Interpreta las gráficas que relacionan las variables implicadas en los movimientos M.R.U., M.R.U.A. y circular uniforme (M.C.U.) aplicando las ecuaciones adecuadas para obtener los valores del espacio recorrido, la velocidad y la aceleración.',20),(34,'B6.5.1','Planteado un supuesto, identifica el tipo o tipos de movimientos implicados, y aplica las ecuaciones de la cinemática para realizar predicciones acerca de la posición y velocidad del móvil.',10),(35,'B6.6.1','Identifica las componentes intrínsecas de la aceleración en distintos casos prácticos y aplica las ecuaciones que permiten determinar su valor.',10),(36,'B6.7.1','Relaciona las magnitudes lineales y angulares para un móvil que describe una trayectoria circular, estableciendo las ecuaciones correspondientes.',10),(37,'B6.8.1','Reconoce movimientos compuestos, establece las ecuaciones que lo describen, calcula el valor de magnitudes tales como, alcance y altura máxima, así como valores instantáneos de posición, velocidad y aceleración.',20),(38,'B6.8.2','Resuelve problemas relativos a la composición de movimientos descomponiéndolos en dos movimientos rectilíneos.',20),(39,'B6.9.2','Interpreta el significado físico de los parámetros que aparecen en la ecuación del movimiento armónico simple.',10),(40,'B6.9.3','Predice la posición de un oscilador armónico simple conociendo la amplitud, la frecuencia, el período y la fase inicial.',10),(41,'B6.9.4','Obtiene la posición, velocidad y aceleración en un movimiento armónico simple aplicando las ecuaciones que lo describen.',10),(42,'B6.9.5','Analiza el comportamiento de la velocidad y de la aceleración de un movimiento armónico simple en función de la elongación.',5),(43,'B7.1.1','Representa todas las fuerzas que actúan sobre un cuerpo, obteniendo la resultante, y extrayendo consecuencias sobre su estado de movimiento.',20),(44,'B7.1.2','Dibuja el diagrama de fuerzas de un cuerpo situado en el interior de un ascensor en diferentes situaciones de movimiento, calculando su aceleración a partir de las leyes de la dinámica.',5),(45,'B7.10.1','Determina las fuerzas electrostática y gravitatoria entre dos partículas de carga y masa conocidas y compara los valores obtenidos, extrapolando conclusiones al caso de los electrones y el núcleo de un átomo.',5),(46,'B7.2.1','Calcula el modulo del momento de una fuerza en casos prácticos sencillos.',10),(47,'B7.2.2','Resuelve supuestos en los que aparezcan fuerzas de rozamiento en planos horizontales o inclinados, aplicando las leyes de Newton.',10),(48,'B7.2.3','Relaciona el movimiento de varios cuerpos unidos mediante cuerdas tensas y poleas con las fuerzas actuantes sobre cada uno de los cuerpos.',5),(49,'B7.4.1','Establece la relación entre impulso mecánico y momento lineal aplicando la segunda ley de Newton.',10),(50,'B7.4.2','Explica el movimiento de dos cuerpos en casos prácticos como colisiones y sistemas de propulsión mediante el principio de conservación del momento lineal.',5),(51,'B7.5.1','Aplica el concepto de fuerza centrípeta para resolver e interpretar casos de móviles en curvas y en trayectorias circulares.',5),(52,'B7.6.2','Describe el movimiento orbital de los planetas del Sistema Solar aplicando las leyes de Kepler y extrae conclusiones acerca del periodo orbital de los mismos.',5),(53,'B7.7.1','Aplica la ley de conservación del momento angular al movimiento elíptico de los planetas, relacionando valores del radio orbital y de la velocidad en diferentes puntos de la órbita.',10),(54,'B7.7.2','Utiliza la ley fundamental de la dinámica para explicar el movimiento orbital de diferentes cuerpos como satélites, planetas y galaxias, relacionando el radio y la velocidad orbital con la masa del cuerpo central.',10),(55,'B7.8.1','Expresa la fuerza de la atracción gravitatoria entre dos cuerpos cualesquiera, conocidas las variables de las que depende, estableciendo cómo inciden los cambios en estas sobre aquella.',10),(56,'B7.8.2','Compara el valor de la atracción gravitatoria de la Tierra sobre un cuerpo en su superficie con la acción de cuerpos lejanos sobre el mismo cuerpo.',10),(57,'B7.9.1','Compara la ley de Newton de la Gravitación Universal y la de Coulomb, estableciendo diferencias y semejanzas entre ellas.',10),(58,'B7.9.2','Halla la fuerza neta que un conjunto de cargas ejerce sobre una carga problema utilizando la ley de Coulomb.',10),(59,'B8.1.1','Aplica el principio de conservación de la energía para resolver problemas mecánicos, determinando valores de velocidad y posición, así como de energía cinética y potencial.',10),(60,'B8.1.2','Relaciona el trabajo que realiza una fuerza sobre un cuerpo con la variación de su energía cinética y determina alguna de las magnitudes implicadas.',10),(61,'B8.2.1','Clasifica en conservativas y no conservativas, las fuerzas que intervienen en un supuesto teórico justificando las transformaciones energéticas que se producen y su relación con el trabajo.',10),(62,'B8.3.1','Estima la energía almacenada en un resorte en función de la elongación, conocida su constante elástica.',10),(63,'B8.3.2','Calcula las energías cinética, potencial y mecánica de un oscilador armónico aplicando el principio de conservación de la energía y realiza la representación gráfica correspondiente.',10),(64,'B8.4.1','Asocia el trabajo necesario para trasladar una carga entre dos puntos de un campo eléctrico con la diferencia de potencial existente entre ellos permitiendo el la determinación de la energía implicada en el proceso.',10);

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

insert  into `tex_config`(`id`,`url`,`nombre`,`version`,`jpeg_quality`,`head`,`foot`) values (1,'http://servermurcia.com/latexamen/','LaTeXaMeN','0.8','95','\\documentclass[10pt]{article}\n\\usepackage{amsmath}\n\\usepackage[forpaper,pointsonboth,nototals,\nnosolutions,allowrandomize\n]{eqexam}\n\n\n\n\\usepackage{chemformula}\n\\usepackage[version=3]{mhchem}\n\\usepackage{varwidth}\n\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage[version=3]{mhchem}\n\\usepackage{booktabs}\n\\usepackage{paralist}\n\\usepackage{framed}\n\\usepackage{setspace}\n\\usepackage[spanish]{babel} \n\\usepackage[left=2.85cm,top=2.5cm,right=2.85cm,bottom=1.25cm]{geometry}\n\\usepackage{tikz}\n\\usepackage{pgfplots}\n\n\\spanishdecimal{,}\n%\\usepackage{times}\n%\\usepackage{newcent}\n%\\usepackage{palatino}\n%\\usepackage{bookman}\n\n\\pointLabel{punto}\n\\pointsLabel{puntos}\n\\ptLabel{pt.}            % singular form\n\\ptsLabel{{pts.}}\n\\eachLabel{\\tiny{apdo.}}\n\\renewcommand\\itemPTsTxt[1]{{\\footnotesize $#1$ pts}}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{document}\n\n\\vspace*{-2.7cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n%Tipo examen y curso, Evaluacion\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\small {Control-1 / 3º de ESO S}}}\\hfill {\\bf{\\small{Segunda Evaluación}}}} \n\\vspace{-0,35cm}\n\\noindent\\makebox[1.05\\linewidth]{{\\bf{\\scriptsize{Diversidad de la materia\\ldots}}}\\hfill\\ {\\bf{\\scriptsize 17 de Junio de 2015}}}\\vspace{0,65cm}\n\\noindent \\makebox[1.05\\linewidth]{Nombre\\dotfill}\\vspace{-0,25cm}\n\\noindent\\rule{1.05\\textwidth}{0,4pt}\n\\vspace*{-1.5cm}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\makeatletter\n% \\eqemargin is the minimum distance to the left margin, plus \\marginparsep.\n% I\'ve removed \\marginparsep to get the minimal positioning. You can insert\n% additional spacing, such as 3pt+\\eqemargin\n\\renewcommand{\\eqleftmargin}[2]{\\makebox[0pt][r]{\\marginpointtext{#1}{#2}%\n    \\setlength{\\@tempdima}{\\eqemargin}%\n%    \\setlength{\\@tempdima}{\\marginparsep+\\eqemargin}%\n    \\hspace*{\\@tempdima}}}\n% important to execute this after the redefinition\n%\\PointsOnLeft\n\\makeatother\n\\lhead{}\n\\chead{}\n\\rhead{}\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n\\begin{exam}{Part1}\n\\forceNoColor\n%\\useFillerLines\n\\useFillerDefault\n%\\fillTypeHRule\n%\\fillTypeDefault\n%\\fillTypeDashLine\n\\fillTypeDots\n\\eqWriteLineColor{blue}\n\\eqWLSpacing{18pt}\n\\vspace*{1cm}','\\vfill\n\\hrule\n\\vspace*{0.2cm}\n\\noindent{\\footnotesize\\emph{{La puntuación total del examen es de \\summaryPointTotal\\ puntos.}}}\n\\end{exam} \n\\end{document}\n\n');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
