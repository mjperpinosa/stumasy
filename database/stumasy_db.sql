-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2014 at 09:18 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stumasy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarms`
--

CREATE TABLE IF NOT EXISTS `alarms` (
  `alarm_id` int(11) NOT NULL AUTO_INCREMENT,
  `alarm_title` varchar(150) DEFAULT NULL,
  `alarm_time` varchar(15) DEFAULT NULL,
  `tone_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`alarm_id`),
  KEY `tone_id` (`tone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `alarms`
--

INSERT INTO `alarms` (`alarm_id`, `alarm_title`, `alarm_time`, `tone_id`) VALUES
(91, 'Wake me up Lord God.', '21:03:00', 1),
(94, 'Call the DOST office Region VIII', '09:30:00', 1),
(95, 'Should go to Carmona', '15:00:00', 1),
(96, 'alarm Should go to Carmona', '24:36:00', 1),
(99, 'n', '01:00:00', 1),
(100, 'n', '01:00:00', 1),
(101, 'now', '12:15:00', 1),
(102, 'again', '00:32:00', 1),
(103, 'again', '00:33:00', 1),
(104, 'again', '00:34:00', 1),
(105, 'again', '00:34:00', 1),
(106, 'again', '00:34:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alarm_tones`
--

CREATE TABLE IF NOT EXISTS `alarm_tones` (
  `tone_id` int(11) NOT NULL AUTO_INCREMENT,
  `tone_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `alarm_tones`
--

INSERT INTO `alarm_tones` (`tone_id`, `tone_title`) VALUES
(1, 'Old MacDonald had a farm'),
(2, 'Let it go'),
(3, 'A thousand miles'),
(4, 'Unending love');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `assignment_detail_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  KEY `assignment_detail_id_in_assignments` (`assignment_detail_id`),
  KEY `item_id_foreign_key_in_assignments` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_detail_id`, `item_id`) VALUES
(4, 5),
(4, 6),
(5, 7),
(5, 8),
(6, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `assignment_details`
--

CREATE TABLE IF NOT EXISTS `assignment_details` (
  `assignment_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `time_added` time DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  PRIMARY KEY (`assignment_detail_id`),
  KEY `subject_id_foreign_key_in_assignment_details` (`subject_id`),
  KEY `topic_id_foreign_key_in_assingment_details` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `assignment_details`
--

INSERT INTO `assignment_details` (`assignment_detail_id`, `subject_id`, `topic_id`, `time_added`, `date_added`) VALUES
(4, 8, 2, '11:32:28', '2014-04-06'),
(5, 1, 1, '00:56:31', '2014-04-07'),
(6, 4, 3, '01:32:35', '2014-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_items`
--

CREATE TABLE IF NOT EXISTS `assignment_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) DEFAULT NULL,
  `answer` varchar(2000) DEFAULT 'no answer',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `assignment_items`
--

INSERT INTO `assignment_items` (`item_id`, `content`, `answer`) VALUES
(5, 'Enumerate all programming languages.', 'PHP, JSP, Ruby, Perl, Python, Visual Basic, Android, Java, C++, Cobol, JavaScript'),
(6, 'Define each.', 'PHP:\n       PHP Hypertext Preprocessor.\nJSP:\n       Java Server Pages'),
(7, 'What are the figures of speech?', 'I don''t know. :3'),
(8, 'Define each.', 'no answer'),
(9, 'Name the planets in the universe.', '1. Mercury\n2. Venus\n3. Earth\n4. Mars\n5. Jupiter\n6. Saturn\n7. Uranus\n8. Neptune'),
(10, 'Give its characteristics.', 'no answer');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedules`
--

CREATE TABLE IF NOT EXISTS `class_schedules` (
  `cs_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_id` int(11) DEFAULT NULL,
  `time_start` varchar(8) DEFAULT NULL,
  `time_end` varchar(8) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `teacher` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cs_id`),
  KEY `day_id` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) DEFAULT NULL,
  `comment_time` varchar(10) DEFAULT NULL,
  `comment_date` varchar(20) DEFAULT NULL,
  `updated` int(11) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE IF NOT EXISTS `definitions` (
  `definition_id` int(11) NOT NULL AUTO_INCREMENT,
  `definition` longtext,
  `reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`definition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `definitions`
--

INSERT INTO `definitions` (`definition_id`, `definition`, `reference`) VALUES
(1, 'is the physical transfer of data (a digital bit stream) over a point-to-point or point-to-multipoint communication channel. Examples of such channels are copper wires, optical fibres, wireless communication channels, and storage media. The data are represented as an electromagnetic signal, such as an electrical voltage, radiowave, microwave, or infrared signal.', 'wiki'),
(2, 'is the physical transfer of data (a digital bit stream) over a point-to-point or point-to-multipoint communication channel. Examples of such channels are copper wires, optical fibres, wireless communication channels, and storage media. The data are represented as an electromagnetic signal, such as an electrical voltage, radiowave, microwave, or infrared signal.', 'wiki'),
(3, 'is the physical transfer of data (a digital bit stream) over a point-to-point or point-to-multipoint communication channel. Examples of such channels are copper wires, optical fibres, wireless communication channels, and storage media. The data are represented as an electromagnetic signal, such as an electrical voltage, radiowave, microwave, or infrared signal.', 'wiki'),
(4, 'The branch of engineeringÂ science that studies (with the aid of computers) computable processes and structures', 'word web'),
(5, '(abbreviated CS or CompSci) is the scientific and practical approach to computation and its applications. It is the systematic study of the feasibility, structure, expression, and mechanization of the methodical processes (or algorithms) that underlie the acquisition, representation, processing, storage, communication of, and access to information, whether such information is encoded in bits and bytes in a computer memory or transcribed engines and protein structures in a human cell.', 'wiki'),
(6, 'Existing only in the mind; separated from embodiment\n"abstract words like ''truth'' and ''justice''"\nNot representing or imitating external reality or the objects of nature\n"a large abstract painting"\nDealing with a subject in the abstract without practical purpose or intention\n"abstract reasoning"; "abstract science"\n(computing) of a class in object-oriented programming, being a partial basis for subclasses rather than being completely defined and directly usable\n\nverb:\nConsider a concept without thinkingÂ of a specific example; consider abstractly or theoretically\nMakeÂ off with belongings of others\nConsider apartÂ from a particular case or instance\n"Let''s abstract away from this particular example"', 'word web'),
(7, 'are used for creating page layouts through a series of rows and columns that house your content.', 'bootstrap'),
(8, '(computing) feature of a computerÂ program or script usedÂ to guide an inexperienced user through a sequence of steps', 'word web'),
(9, '(computing) a code for information exchange between computers made by different companies; a string of 7 binaryÂ digits represents each character; used in most microcomputers', 'word web'),
(10, 'is a branch of mathematics concerning the study of finite or countable discrete structures. Aspects of combinatorics include counting the structures of a given kind and size (enumerative combinatorics), deciding when certain criteria can be met, and constructing and analyzing objects meeting the criteria (as in combinatorial designs and matroid theory), finding "largest", "smallest", or "optimal" objects (extremal combinatorics and combinatorial optimization), and studying combinatorial structures arising in an algebraic context, or applying algebraic techniques to combinatorial problems (algebraic combinatorics).', 'wikipedia'),
(11, 'Combinatorial problems arise in many areas of pure mathematics, notably in algebra, probability theory, topology, and geometry, and combinatorics also has many applications in optimization, computer science, ergodic theory and statistical physics. Many combinatorial questions have historically been considered in isolation, giving an ad hoc solution to a problem arising in some mathematical context. In the later twentieth century, however, powerful and general theoretical methods were developed, making combinatorics into an independent branch of mathematics in its own right. One of the oldest and most accessible parts of combinatorics is graph theory, which also has numerous natural connections to other areas. Combinatorics is used frequently in computer science to obtain formulas and estimates in the analysis of algorithms.\n\nA mathematician who studies combinatorics is called a combinatorialist or a combinatorist.', 'wikipedia'),
(12, '(science) a science (or group of related sciences) dealing with the logic of quantity and shape and arrangement', 'word web'),
(13, 'English mathematician who conceivedÂ of the TuringÂ machine and broke German codes during WorldÂ WarÂ II (1912-1954)', 'word web'),
(14, 'Any logicalÂ system that abstracts the form of statements away from their content inÂ orderÂ to establish abstract criteria of consistency and validity', 'word web'),
(15, 'French philosopher and mathematician; developed dualistic theory of mind and matter; introduced the use of coordinates to locate a point in two or three dimensions (1596-1650)', 'word web'),
(16, 'The branch of computer science that deal with writing computer programs that can solve problems creatively', 'word web'),
(17, 'The use of computers to translate from one language to another', 'word web'),
(18, 'The use of computers for linguistic research and applications', 'word web'),
(19, 'The scientific study of language; The humanistic study of language and literature', 'word web'),
(20, 'The humanistic study of language and literature', 'word web'),
(21, 'The branch of philology that is devoted to the study of dialects', 'word web'),
(22, '(computing) an electronicÂ device for processing information and performing calculations; follows a program to perform sequences of mathematical and logicalÂ operations;\n\nAn expert at calculation (or at operating calculatingÂ machines)', 'word web'),
(23, '(computerÂ programming) an algorithm or object usedÂ to negotiate mutual exclusion among threads', 'word web'),
(24, 'A powerful microscope whose image is made by scanning a beam of electrons', 'word web'),
(25, 'A powerful microscope whose image is made by scanning a beam of electrons', 'word web'),
(26, 'A terrorist organization in Sri Lanka that began in 1970 as a student protest over the limited university access for Tamil students; currently seeks to establish an independent Tamil state called Eelam; relies on guerilla strategy including terrorist tactics that target key government and military personnel', 'word web'),
(27, 'A terrorist organization in Sri Lanka that began in 1970 as a student protest over the limited university access for Tamil students; currently seeks to establish an independent Tamil state called Eelam; relies on guerilla strategy including terrorist tactics that target key government and military personnel', 'word web'),
(28, 'The time of an event recorded by a computer, such as the date and time associated when a file was saved.', 'word web');

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE IF NOT EXISTS `dictionary` (
  `dictionary_id` int(11) NOT NULL AUTO_INCREMENT,
  `word_id` int(11) DEFAULT NULL,
  `definition_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dictionary_id`),
  KEY `word_id_foreign_key` (`word_id`),
  KEY `definition_id_foreign_key` (`definition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `dictionary`
--

INSERT INTO `dictionary` (`dictionary_id`, `word_id`, `definition_id`) VALUES
(8, 2, 1),
(9, 3, 2),
(10, 4, 3),
(11, 5, 4),
(12, 5, 5),
(13, 6, 6),
(14, 1, 7),
(15, 7, 8),
(16, 8, 9),
(17, 9, 10),
(18, 9, 11),
(19, 10, 12),
(20, 11, 13),
(21, 12, 14),
(22, 13, 15),
(23, 14, 16),
(24, 15, 17),
(25, 16, 18),
(26, 17, 19),
(27, 18, 20),
(28, 19, 21),
(29, 20, 22),
(30, 21, 23),
(31, 22, 24),
(32, 23, 25),
(33, 24, 26),
(34, 25, 27),
(35, 26, 28);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(200) DEFAULT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_type`) VALUES
(7, '894157382.jpg', 'image'),
(13, '1298225808.jpg', 'image'),
(14, '1678239.jpg', 'image'),
(15, '977380847.jpg', 'image'),
(16, '527053256.jpg', 'image');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE IF NOT EXISTS `lectures` (
  `lecture_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `content` mediumtext,
  PRIMARY KEY (`lecture_id`),
  KEY `subject_id_foreign_key` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lecture_id`, `subject_id`, `topic`, `content`) VALUES
(1, 8, 'AI', 'The branch of computerÂ science that deal with writing computerÂ programs that can solve problems creatively'),
(2, 8, 'Artificial Intelligence', 'Artificial intelligence (AI) is the intelligence exhibited by machines or software, and the branch of computer science that develops machines and software with intelligence. Major AI researchers and textbooks define the field as "the study and design of intelligent agents", where an intelligent agent is a system that perceives its environment and takes actions that maximize its chances of success. John McCarthy, who coined the term in 1955, defines it as "the science and engineering of making intelligent machines".\n\nAI research is highly technical and specialised, and is deeply divided into subfields that often fail to communicate with each other. Some of the division is due to social and cultural factors: subfields have grown up around particular institutions and the work of individual researchers. AI research is also divided by several technical issues. Some subfields focus on the solution of specific problems. Others focus on one of several possible approaches or on the use of a particular tool or towards the accomplishment of particular applications.\n\nThe central problems (or goals) of AI research include reasoning, knowledge, planning, learning, communication, perception and the ability to move and manipulate objects. General intelligence (or "strong AI") is still among the field''s long term goals. Currently popular approaches include statistical methods, computational intelligence and traditional symbolic AI. There are an enormous number of tools used in AI, including versions of search and mathematical optimization, logic, methods based on probability and economics, and many others.\n\nThe field was founded on the claim that a central property of humans, intelligenceâ€”the sapience of Homo sapiensâ€”can be so precisely described that it can be simulated by a machine. This raises philosophical issues about the nature of the mind and the ethics of creating artificial beings, issues which have been addressed by myth, fiction and philosophy since antiquity. Artificial intelligence has been the subject of tremendous optimism but has also suffered stunning setbacks. Today it has become an essential part of the technology industry and many of the most difficult problems in computer science.\n\nHistory\n\nThinking machines and artificial beings appear in Greek myths, such as Talos of Crete, the bronze robot of Hephaestus, and Pygmalion''s Galatea. Human likenesses believed to have intelligence were built in every major civilization: animated cult images were worshiped in Egypt and Greece and humanoid automatons were built by Yan Shi, Hero of Alexandria and Al-Jazari. It was also widely believed that artificial beings had been created by JÄbir ibn HayyÄn, Judah Loew and Paracelsus. By the 19th and 20th centuries, artificial beings had become a common feature in fiction, as in Mary Shelley''s Frankenstein or Karel ÄŒapek''s R.U.R. (Rossum''s Universal Robots). Pamela McCorduck argues that all of these are examples of an ancient urge, as she describes it, "to forge the gods". Stories of these creatures and their fates discuss many of the same hopes, fears and ethical concerns that are presented by artificial intelligence.\n\nMechanical or "formal" reasoning has been developed by philosophers and mathematicians since antiquity. The study of logic led directly to the invention of the programmable digital electronic computer, based on the work of mathematician Alan Turing and others. Turing''s theory of computation suggested that a machine, by shuffling symbols as simple as "0" and "1", could simulate any conceivable act of mathematical deduction. This, along with concurrent discoveries in neurology, information theory and cybernetics, inspired a small group of researchers to begin to seriously consider the possibility of building an electronic brain.\n\nThe field of AI research was founded at a conference on the campus of Dartmouth College in the summer of 1956. The attendees, including John McCarthy, Marvin Minsky, Allen Newell and Herbert Simon, became the leaders of AI research for many decades. They and their students wrote programs that were, to most people, simply astonishing: Computers were solving word problems in algebra, proving logical theorems and speaking English. By the middle of the 1960s, research in the U.S. was heavily funded by the Department of Defense and laboratories had been established around the world. AI''s founders were profoundly optimistic about the future of the new field: Herbert Simon predicted that "machines will be capable, within twenty years, of doing any work a man can do" and Marvin Minsky agreed, writing that "within a generation ... the problem of creating ''artificial intelligence'' will substantially be solved".\n\nThey had failed to recognize the difficulty of some of the problems they faced. In 1974, in response to the criticism of Sir James Lighthill and ongoing pressure from the US Congress to fund more productive projects, both the U.S. and British governments cut off all undirected exploratory research in AI. The next few years would later be called an "AI winter", a period when funding for AI projects was hard to find.\n\nIn the early 1980s, AI research was revived by the commercial success of expert systems,[30] a form of AI program that simulated the knowledge and analytical skills of one or more human experts. By 1985 the market for AI had reached over a billion dollars. At the same time, Japan''s fifth generation computer project inspired the U.S and British governments to restore funding for academic research in the field.[31] However, beginning with the collapse of the Lisp Machine market in 1987, AI once again fell into disrepute, and a second, longer lasting AI winter began.\n\nIn the 1990s and early 21st century, AI achieved its greatest successes, albeit somewhat behind the scenes. Artificial intelligence is used for logistics, data mining, medical diagnosis and many other areas throughout the technology industry. The success was due to several factors: the increasing computational power of computers (see Moore''s law), a greater emphasis on solving specific subproblems, the creation of new ties between AI and other fields working on similar problems, and a new commitment by researchers to solid mathematical methods and rigorous scientific standards.\n\nOn 11 May 1997, Deep Blue became the first computer chess-playing system to beat a reigning world chess champion, Garry Kasparov. In 2005, a Stanford robot won the DARPA Grand Challenge by driving autonomously for 131 miles along an unrehearsed desert trail. Two years later, a team from CMU won the DARPA Urban Challenge when their vehicle autonomously navigated 55 miles in an urban environment while adhering to traffic hazards and all traffic laws.[36] In 2010,the "intelligence" which reveals the nature of intelligence is defined based on primitive semantics through analyzing why intelligence needs to be defined with perception-based semantics and why human doubts Deep Blue''s intelligence although it had defeated Garry Kasparov, it also reveals that the "intelligence" which is usually said is a human level one,and points out that the ultimate world is the longevity human and machine intelligence co-existing world. In February 2011, in a Jeopardy! quiz show exhibition match, IBM''s question answering system, Watson, defeated the two greatest Jeopardy champions, Brad Rutter and Ken Jennings, by a significant margin. The Kinect, which provides a 3D bodyâ€“motion interface for the Xbox 360 and the Xbox One, uses algorithms that emerged from lengthy AI research as does the iPhone''s Siri.\nGoals\n\nThe general problem of simulating (or creating) intelligence has been broken down into a number of specific sub-problems. These consist of particular traits or capabilities that researchers would like an intelligent system to display. The traits described below have received the most attention.\nDeduction, reasoning, problem solving\n\nEarly AI researchers developed algorithms that imitated the step-by-step reasoning that humans use when they solve puzzles or make logical deductions. By the late 1980s and 1990s, AI research had also developed highly successful methods for dealing with uncertain or incomplete information, employing concepts from probability and economics.\n\nFor difficult problems, most of these algorithms can require enormous computational resources â€“ most experience a "combinatorial explosion": the amount of memory or computer time required becomes astronomical when the problem goes beyond a certain size. The search for more efficient problem-solving algorithms is a high priority for AI research.\n\nHuman beings solve most of their problems using fast, intuitive judgements rather than the conscious, step-by-step deduction that early AI research was able to model. AI has made some progress at imitating this kind of "sub-symbolic" problem solving: embodied agent approaches emphasize the importance of sensorimotor skills to higher reasoning; neural net research attempts to simulate the structures inside the brain that give rise to this skill; statistical approaches to AI mimic the probabilistic nature of the human ability to guess.\nKnowledge representation\nAn ontology represents knowledge as a set of concepts within a domain and the relationships between those concepts.\nMain articles: Knowledge representation and Commonsense knowledge\n\nKnowledge representation and knowledge engineering are central to AI research. Many of the problems machines are expected to solve will require extensive knowledge about the world. Among the things that AI needs to represent are: objects, properties, categories and relations between objects; situations, events, states and time; causes and effects; knowledge about knowledge (what we know about what other people know); and many other, less well researched domains. A representation of "what exists" is an ontology: the set of objects, relations, concepts and so on that the machine knows about. The most general are called upper ontologies, which attempt to provide a foundation for all other knowledge.\n\nAmong the most difficult problems in knowledge representation are:\n\nDefault reasoning and the qualification problem\n    Many of the things people know take the form of "working assumptions." For example, if a bird comes up in conversation, people typically picture an animal that is fist sized, sings, and flies. None of these things are true about all birds. John McCarthy identified this problem in 1969 as the qualification problem: for any commonsense rule that AI researchers care to represent, there tend to be a huge number of exceptions. Almost nothing is simply true or false in the way that abstract logic requires. AI research has explored a number of solutions to this problem.[\n\nThe breadth of commonsense knowledge\n    The number of atomic facts that the average person knows is astronomical. Research projects that attempt to build a complete knowledge base of commonsense knowledge (e.g., Cyc) require enormous amounts of laborious ontological engineering â€” they must be built, by hand, one complicated concept at a time.[53] A major goal is to have the computer understand enough concepts to be able to learn by reading from sources like the internet, and thus be able to add to its own ontology.[citation needed]\n\nThe subsymbolic form of some commonsense knowledge\n    Much of what people know is not represented as "facts" or "statements" that they could express verbally. For example, a chess master will avoid a particular chess position because it "feels too exposed"[54] or an art critic can take one look at a statue and instantly realize that it is a fake. These are intuitions or tendencies that are represented in the brain non-consciously and sub-symbolically.[56] Knowledge like this informs, supports and provides a context for symbolic, conscious knowledge. As with the related problem of sub-symbolic reasoning, it is hoped that situated AI, computational intelligence, or statistical AI will provide ways to represent this kind of knowledge.\n\nPlanning\nA hierarchical control system is a form of control system in which a set of devices and governing software is arranged in a hierarchy.\nMain article: Automated planning and scheduling\n\nIntelligent agents must be able to set goals and achieve them. They need a way to visualize the future (they must have a representation of the state of the world and be able to make predictions about how their actions will change it) and be able to make choices that maximize the utility (or "value") of the available choices.\n\nIn classical planning problems, the agent can assume that it is the only thing acting on the world and it can be certain what the consequences of its actions may be. However, if the agent is not the only actor, it must periodically ascertain whether the world matches its predictions and it must change its plan as this becomes necessary, requiring the agent to reason under uncertainty.\n\nMulti-agent planning uses the cooperation and competition of many agents to achieve a given goal. Emergent behavior such as this is used by evolutionary algorithms and swarm intelligence.\nLearning\nMain article: Machine learning\n\nMachine learning is the study of computer algorithms that improve automatically through experience and has been central to AI research since the field''s inception.\n\nUnsupervised learning is the ability to find patterns in a stream of input. Supervised learning includes both classification and numerical regression. Classification is used to determine what category something belongs in, after seeing a number of examples of things from several categories. Regression is the attempt to produce a function that describes the relationship between inputs and outputs and predicts how the outputs should change as the inputs change. In reinforcement learning the agent is rewarded for good responses and punished for bad ones. These can be analyzed in terms of decision theory, using concepts like utility. The mathematical analysis of machine learning algorithms and their performance is a branch of theoretical computer science known as computational learning theory.\n\nWithin developmental robotics, developmental learning approaches were elaborated for lifelong cumulative acquisition of repertoires of novel skills by a robot, through autonomous self-exploration and social interaction with human teachers, and using guidance mechanisms such as active learning, maturation, motor synergies, and imitation.\nNatural language processing\nA parse tree represents the syntactic structure of a sentence according to some formal grammar.\nMain article: Natural language processing\n\nNatural language processing gives machines the ability to read and understand the languages that humans speak. A sufficiently powerful natural language processing system would enable natural language user interfaces and the acquisition of knowledge directly from human-written sources, such as Internet texts. Some straightforward applications of natural language processing include information retrieval (or text mining) and machine translation.\n\nA common method of processing and extracting meaning from natural language is through semantic indexing. Increases in processing speeds and the drop in the cost of data storage makes indexing large volumes of abstractions of the users input much more efficient.\nMotion and manipulation\nMain article: Robotics\n\nThe field of robotics is closely related to AI. Intelligence is required for robots to be able to handle such tasks as object manipulation and navigation, with sub-problems of localization (knowing where you are, or finding out where other things are), mapping (learning what is around you, building a map of the environment), and motion planning (figuring out how to get there) or path planning (going from one point in space to another point, which may involve compliant motion - where the robot moves while maintaining physical contact with an object).\nPerception\nMain articles: Machine perception, Computer vision, and Speech recognition\n\nMachine perception is the ability to use input from sensors (such as cameras, microphones, tactile sensors, sonar and others more exotic) to deduce aspects of the world. Computer vision is the ability to analyze visual input. A few selected subproblems are speech recognition, facial recognition and object recognition.\nSocial intelligence\nMain article: Affective computing\nKismet, a robot with rudimentary social skills\n\nAffective computing is the study and development of systems and devices that can recognize, interpret, process, and simulate human affects. It is an interdisciplinary field spanning computer sciences, psychology, and cognitive science.[84] While the origins of the field may be traced as far back as to early philosophical inquiries into emotion, the more modern branch of computer science originated with Rosalind Picard''s 1995 paper[86] on affective computing. A motivation for the research is the ability to simulate empathy. The machine should interpret the emotional state of humans and adapt its behaviour to them, giving an appropriate response for those emotions.\n\nEmotion and social skills[89] play two roles for an intelligent agent. First, it must be able to predict the actions of others, by understanding their motives and emotional states. (This involves elements of game theory, decision theory, as well as the ability to model human emotions and the perceptual skills to detect emotions.) Also, in an effort to facilitate human-computer interaction, an intelligent machine might want to be able to display emotionsâ€”even if it does not actually experience them itselfâ€”in order to appear sensitive to the emotional dynamics of human interaction.\nCreativity\nMain article: Computational creativity\n\nA sub-field of AI addresses creativity both theoretically (from a philosophical and psychological perspective) and practically (via specific implementations of systems that generate outputs that can be considered creative, or systems that identify and assess creativity). Related areas of computational research are Artificial intuition and Artificial thinking.\nGeneral intelligence\nMain articles: Artificial general intelligence and AI-complete\n\nMany researchers think that their work will eventually be incorporated into a machine with general intelligence (known as strong AI), combining all the skills above and exceeding human abilities at most or all of them. A few believe that anthropomorphic features like artificial consciousness or an artificial brain may be required for such a project.\n\nMany of the problems above may require general intelligence to be considered solved. For example, even a straightforward, specific task like machine translation requires that the machine read and write in both languages (NLP), follow the author''s argument (reason), know what is being talked about (knowledge), and faithfully reproduce the author''s intention (social intelligence). A problem like machine translation is considered "AI-complete". In order to solve this particular problem, you must solve all the problems.\nApproaches\n\nThere is no established unifying theory or paradigm that guides AI research. Researchers disagree about many issues. A few of the most long standing questions that have remained unanswered are these: should artificial intelligence simulate natural intelligence by studying psychology or neurology? Or is human biology as irrelevant to AI research as bird biology is to aeronautical engineering? Can intelligent behavior be described using simple, elegant principles (such as logic or optimization)? Or does it necessarily require solving a large number of completely unrelated problems? Can intelligence be reproduced using high-level symbols, similar to words and ideas? Or does it require "sub-symbolic" processing? John Haugeland, who coined the term GOFAI (Good Old-Fashioned Artificial Intelligence), also proposed that AI should more properly be referred to as synthetic intelligence, a term which has since been adopted by some non-GOFAI researchers.\nCybernetics and brain simulation\nMain articles: Cybernetics and Computational neuroscience\n\nIn the 1940s and 1950s, a number of researchers explored the connection between neurology, information theory, and cybernetics. Some of them built machines that used electronic networks to exhibit rudimentary intelligence, such as W. Grey Walter''s turtles and the Johns Hopkins Beast. Many of these researchers gathered for meetings of the Teleological Society at Princeton University and the Ratio Club in England.[20] By 1960, this approach was largely abandoned, although elements of it would be revived in the 1980s.\nSymbolic[edit]\nMain article: GOFAI\n\nWhen access to digital computers became possible in the middle 1950s, AI research began to explore the possibility that human intelligence could be reduced to symbol manipulation. The research was centered in three institutions: Carnegie Mellon University, Stanford and MIT, and each one developed its own style of research. John Haugeland named these approaches to AI "good old fashioned AI" or "GOFAI".[100] During the 1960s, symbolic approaches had achieved great success at simulating high-level thinking in small demonstration programs. Approaches based on cybernetics or neural networks were abandoned or pushed into the background. Researchers in the 1960s and the 1970s were convinced that symbolic approaches would eventually succeed in creating a machine with artificial general intelligence and considered this the goal of their field.\n\nCognitive simulation\n    Economist Herbert Simon and Allen Newell studied human problem-solving skills and attempted to formalize them, and their work laid the foundations of the field of artificial intelligence, as well as cognitive science, operations research and management science. Their research team used the results of psychological experiments to develop programs that simulated the techniques that people used to solve problems. This tradition, centered at Carnegie Mellon University would eventually culminate in the development of the Soar architecture in the middle 1980s.\n\nLogic-based\n    Unlike Newell and Simon, John McCarthy felt that machines did not need to simulate human thought, but should instead try to find the essence of abstract reasoning and problem solving, regardless of whether people used the same algorithms. His laboratory at Stanford (SAIL) focused on using formal logic to solve a wide variety of problems, including knowledge representation, planning and learning. Logic was also the focus of the work at the University of Edinburgh and elsewhere in Europe which led to the development of the programming language Prolog and the science of logic programming.\n\n"Anti-logic" or "scruffy"\n    Researchers at MIT (such as Marvin Minsky and Seymour Papert) found that solving difficult problems in vision and natural language processing required ad-hoc solutions â€“ they argued that there was no simple and general principle (like logic) that would capture all the aspects of intelligent behavior. Roger Schank described their "anti-logic" approaches as "scruffy" (as opposed to the "neat" paradigms at CMU and Stanford). Commonsense knowledge bases (such as Doug Lenat''s Cyc) are an example of "scruffy" AI, since they must be built by hand, one complicated concept at a time.\n\nKnowledge-based\n    When computers with large memories became available around 1970, researchers from all three traditions began to build knowledge into AI applications. This "knowledge revolution" led to the development and deployment of expert systems (introduced by Edward Feigenbaum), the first truly successful form of AI software. The knowledge revolution was also driven by the realization that enormous amounts of knowledge would be required by many simple AI applications.\n\nSub-symbolic\n\nBy the 1980s progress in symbolic AI seemed to stall and many believed that symbolic systems would never be able to imitate all the processes of human cognition, especially perception, robotics, learning and pattern recognition. A number of researchers began to look into "sub-symbolic" approaches to specific AI problems.\n\nBottom-up, embodied, situated, behavior-based or nouvelle AI\n    Researchers from the related field of robotics, such as Rodney Brooks, rejected symbolic AI and focused on the basic engineering problems that would allow robots to move and survive. Their work revived the non-symbolic viewpoint of the early cybernetics researchers of the 1950s and reintroduced the use of control theory in AI. This coincided with the development of the embodied mind thesis in the related field of cognitive science: the idea that aspects of the body (such as movement, perception and visualization) are required for higher intelligence.\n\nComputational intelligence\n    Interest in neural networks and "connectionism" was revived by David Rumelhart and others in the middle 1980s. These and other sub-symbolic approaches, such as fuzzy systems and evolutionary computation, are now studied collectively by the emerging discipline of computational intelligence.\n\nStatistical\n\nIn the 1990s, AI researchers developed sophisticated mathematical tools to solve specific subproblems. These tools are truly scientific, in the sense that their results are both measurable and verifiable, and they have been responsible for many of AI''s recent successes. The shared mathematical language has also permitted a high level of collaboration with more established fields (like mathematics, economics or operations research). Stuart Russell and Peter Norvig describe this movement as nothing less than a "revolution" and "the victory of the neats." Critics argue that these techniques are too focused on particular problems and have failed to address the long term goal of general intelligence. There is an ongoing debate about the relevance and validity of statistical approaches in AI, exemplified in part by exchanges between Peter Norvig and Noam Chomsky.\nIntegrating the approaches\n\nIntelligent agent paradigm\n    An intelligent agent is a system that perceives its environment and takes actions which maximize its chances of success. The simplest intelligent agents are programs that solve specific problems. More complicated agents include human beings and organizations of human beings (such as firms). The paradigm gives researchers license to study isolated problems and find solutions that are both verifiable and useful, without agreeing on one single approach. An agent that solves a specific problem can use any approach that works â€“ some agents are symbolic and logical, some are sub-symbolic neural networks and others may use new approaches. The paradigm also gives researchers a common language to communicate with other fieldsâ€”such as decision theory and economicsâ€”that also use concepts of abstract agents. The intelligent agent paradigm became widely accepted during the 1990s.\n\nAgent architectures and cognitive architectures\n    Researchers have designed systems to build intelligent systems out of interacting intelligent agents in a multi-agent system. A system with both symbolic and sub-symbolic components is a hybrid intelligent system, and the study of such systems is artificial intelligence systems integration. A hierarchical control system provides a bridge between sub-symbolic AI at its lowest, reactive levels and traditional symbolic AI at its highest levels, where relaxed time constraints permit planning and world modelling. Rodney Brooks'' subsumption architecture was an early proposal for such a hierarchical system.\n\nTools\n\nIn the course of 50 years of research, AI has developed a large number of tools to solve the most difficult problems in computer science. A few of the most general of these methods are discussed below.\nSearch and optimization\nMain articles: Search algorithm, Mathematical optimization, and Evolutionary computation\n\nMany problems in AI can be solved in theory by intelligently searching through many possible solutions: Reasoning can be reduced to performing a search. For example, logical proof can be viewed as searching for a path that leads from premises to conclusions, where each step is the application of an inference rule. Planning algorithms search through trees of goals and subgoals, attempting to find a path to a target goal, a process called means-ends analysis. Robotics algorithms for moving limbs and grasping objects use local searches in configuration space. Many learning algorithms use search algorithms based on optimization.this is a very important conceptual technology\n\n\nSimple exhaustive searches are rarely sufficient for most real world problems: the search space (the number of places to search) quickly grows to astronomical numbers. The result is a search that is too slow or never completes. The solution, for many problems, is to use "heuristics" or "rules of thumb" that eliminate choices that are unlikely to lead to the goal (called "pruning the search tree"). Heuristics supply the program with a "best guess" for the path on which the solution lies. Heuristics limit the search for solutions into a smaller sample size.\n\nA very different kind of search came to prominence in the 1990s, based on the mathematical theory of optimization. For many problems, it is possible to begin the search with some form of a guess and then refine the guess incrementally until no more refinements can be made. These algorithms can be visualized as blind hill climbing: we begin the search at a random point on the landscape, and then, by jumps or steps, we keep moving our guess uphill, until we reach the top. Other optimization algorithms are simulated annealing, beam search and random optimization.\n\nEvolutionary computation uses a form of optimization search. For example, they may begin with a population of organisms (the guesses) and then allow them to mutate and recombine, selecting only the fittest to survive each generation (refining the guesses). Forms of evolutionary computation include swarm intelligence algorithms (such as ant colony or particle swarm optimization) and evolutionary algorithms (such as genetic algorithms, gene expression programming, and genetic programming).\nLogic\nMain articles: Logic programming and Automated reasoning\n\nLogic is used for knowledge representation and problem solving, but it can be applied to other problems as well. For example, the satplan algorithm uses logic for planning and inductive logic programming is a method for learning.\n\nSeveral different forms of logic are used in AI research. Propositional or sentential logic is the logic of statements which can be true or false. First-order logic[130] also allows the use of quantifiers and predicates, and can express facts about objects, their properties, and their relations with each other. Fuzzy logic,[131] is a version of first-order logic which allows the truth of a statement to be represented as a value between 0 and 1, rather than simply True (1) or False (0). Fuzzy systems can be used for uncertain reasoning and have been widely used in modern industrial and consumer product control systems. Subjective logic models uncertainty in a different and more explicit manner than fuzzy-logic: a given binomial opinion satisfies belief + disbelief + uncertainty = 1 within a Beta distribution. By this method, ignorance can be distinguished from probabilistic statements that an agent makes with high confidence.\n\nDefault logics, non-monotonic logics and circumscription are forms of logic designed to help with default reasoning and the qualification problem. Several extensions of logic have been designed to handle specific domains of knowledge, such as: description logics; situation calculus, event calculus and fluent calculus (for representing events and time); causal calculus; belief calculus; and modal logics.\nProbabilistic methods for uncertain reasoning\nMain articles: Bayesian network, Hidden Markov model, Kalman filter, Decision theory, and Utility theory\n\nMany problems in AI (in reasoning, planning, learning, perception and robotics) require the agent to operate with incomplete or uncertain information. AI researchers have devised a number of powerful tools to solve these problems using methods from probability theory and economics.\n\nBayesian networks are a very general tool that can be used for a large number of problems: reasoning (using the Bayesian inference algorithm), learning (using the expectation-maximization algorithm), planning (using decision networks) and perception (using dynamic Bayesian networks). Probabilistic algorithms can also be used for filtering, prediction, smoothing and finding explanations for streams of data, helping perception systems to analyze processes that occur over time (e.g., hidden Markov models or Kalman filters).\n\nA key concept from the science of economics is "utility": a measure of how valuable something is to an intelligent agent. Precise mathematical tools have been developed that analyze how an agent can make choices and plan, using decision theory, decision analysis, information value theory. These tools include models such as Markov decision processes, dynamic decision networks, game theory and mechanism design.\nClassifiers and statistical learning methods[edit]\nMain articles: Classifier (mathematics), Statistical classification, and Machine learning\n\nThe simplest AI applications can be divided into two types: classifiers ("if shiny then diamond") and controllers ("if shiny then pick up"). Controllers do however also classify conditions before inferring actions, and therefore classification forms a central part of many AI systems. Classifiers are functions that use pattern matching to determine a closest match. They can be tuned according to examples, making them very attractive for use in AI. These examples are known as observations or patterns. In supervised learning, each pattern belongs to a certain predefined class. A class can be seen as a decision that has to be made. All the observations combined with their class labels are known as a data set. When a new observation is received, that observation is classified based on previous experience.\n\nA classifier can be trained in various ways; there are many statistical and machine learning approaches. The most widely used classifiers are the neural network, kernel methods such as the support vector machine, k-nearest neighbor algorithm, Gaussian mixture model, naive Bayes classifier, and decision tree. The performance of these classifiers have been compared over a wide range of tasks. Classifier performance depends greatly on the characteristics of the data to be classified. There is no single classifier that works best on all given problems; this is also referred to as the "no free lunch" theorem. Determining a suitable classifier for a given problem is still more an art than science.\nNeural networks\nMain articles: Neural network and Connectionism\nA neural network is an interconnected group of nodes, akin to the vast network of neurons in the human brain.\n\nThe study of artificial neural networks began in the decade before the field AI research was founded, in the work of Walter Pitts and Warren McCullough. Other important early researchers were Frank Rosenblatt, who invented the perceptron and Paul Werbos who developed the backpropagation algorithm.\n\nThe main categories of networks are acyclic or feedforward neural networks (where the signal passes in only one direction) and recurrent neural networks (which allow feedback). Among the most popular feedforward networks are perceptrons, multi-layer perceptrons and radial basis networks. Among recurrent networks, the most famous is the Hopfield net, a form of attractor network, which was first described by John Hopfield in 1982. Neural networks can be applied to the problem of intelligent control (for robotics) or learning, using such techniques as Hebbian learning and competitive learning.\n\nHierarchical temporal memory is an approach that models some of the structural and algorithmic properties of the neocortex.\nControl theory\nMain article: Intelligent control\n\nControl theory, the grandchild of cybernetics, has many important applications, especially in robotics.\nLanguages\nMain article: List of programming languages for artificial intelligence\n\nAI researchers have developed several specialized languages for AI research, including Lisp[156] and Prolog.\nEvaluating progress\nMain article: Progress in artificial intelligence\n\nIn 1950, Alan Turing proposed a general procedure to test the intelligence of an agent now known as the Turing test. This procedure allows almost all the major problems of artificial intelligence to be tested. However, it is a very difficult challenge and at present all agents fail.\n\nArtificial intelligence can also be evaluated on specific problems such as small problems in chemistry, hand-writing recognition and game-playing. Such tests have been termed subject matter expert Turing tests. Smaller problems provide more achievable goals and there are an ever-increasing number of positive results.\n\nOne classification for outcomes of an AI test is:\n\n    Optimal: it is not possible to perform better.\n    Strong super-human: performs better than all humans.\n    Super-human: performs better than most humans.\n    Sub-human: performs worse than most humans.\n\nFor example, performance at draughts (i.e. checkers) is optimal, performance at chess is super-human and nearing strong super-human (see computer chess: computers versus human) and performance at many everyday tasks (such as recognizing a face or crossing a room without bumping into something) is sub-human.\n\nA quite different approach measures machine intelligence through tests which are developed from mathematical definitions of intelligence. Examples of these kinds of tests start in the late nineties devising intelligence tests using notions from Kolmogorov complexity and data compression. Two major advantages of mathematical definitions are their applicability to nonhuman intelligences and their absence of a requirement for human testers.\n\nAn area that artificial intelligence had contributed greatly to is Intrusion detection.\n\nA derivative of the Turing test is the Completely Automated Public Turing test to tell Computers and Humans Apart (CAPTCHA). as the name implies, this helps to determine that a user is an actual person and not a computer posing as a human. In contrast to the standard Turing test, CAPTCHA administered by a machine and targeted to a human as opposed to being administered by a human and targeted to a machine. A computer asks a user to complete a simple test then generates a grade for that test. Computers are unable to solve the problem, so correct solutions are deemed to be the result of a person taking the test. A common type of CAPTCHA is the test that requires the typing of distorted letters, numbers or symbols that appear in an image undecipherable by a computer.\nApplications\nAn automated online assistant providing customer service on a web page â€“ one of many very primitive applications of artificial intelligence.\nMain article: Applications of artificial intelligence\n\nArtificial intelligence techniques are pervasive and are too numerous to list. Frequently, when a technique reaches mainstream use, it is no longer considered artificial intelligence; this phenomenon is described as the AI effect.\nCompetitions and prizes\nMain article: Competitions and prizes in artificial intelligence\n\nThere are a number of competitions and prizes to promote research in artificial intelligence. The main areas promoted are: general machine intelligence, conversational behavior, data-mining, robotic cars, robot soccer and games.\nPlatforms\n\nA platform (or "computing platform") is defined as "some sort of hardware architecture or software framework (including application frameworks), that allows software to run." As Rodney Brooks[166] pointed out many years ago, it is not just the artificial intelligence software that defines the AI features of the platform, but rather the actual platform itself that affects the AI that results, i.e., there needs to be work in AI problems on real-world platforms rather than in isolation.\n\nA wide variety of platforms has allowed different aspects of AI to develop, ranging from expert systems, albeit PC-based but still an entire real-world system, to various robot platforms such as the widely available Roomba with open interface.\nPhilosophy[edit]\nMain article: Philosophy of artificial intelligence\n\nArtificial intelligence, by claiming to be able to recreate the capabilities of the human mind, is both a challenge and an inspiration for philosophy. Are there limits to how intelligent machines can be? Is there an essential difference between human intelligence and artificial intelligence? Can a machine have a mind and consciousness? A few of the most influential answers to these questions are given below.\n\nTuring''s "polite convention"\n    We need not decide if a machine can "think"; we need only decide if a machine can act as intelligently as a human being. This approach to the philosophical problems associated with artificial intelligence forms the basis of the Turing test.\n\nThe Dartmouth proposal\n    "Every aspect of learning or any other feature of intelligence can be so precisely described that a machine can be made to simulate it." This conjecture was printed in the proposal for the Dartmouth Conference of 1956, and represents the position of most working AI researchers.\n\nNewell and Simon''s physical symbol system hypothesis\n    "A physical symbol system has the necessary and sufficient means of general intelligent action." Newell and Simon argue that intelligences consist of formal operations on symbols. Hubert Dreyfus argued that, on the contrary, human expertise depends on unconscious instinct rather than conscious symbol manipulation and on having a "feel" for the situation rather than explicit symbolic knowledge. (See Dreyfus'' critique of AI.)\n\nGÃ¶del''s incompleteness theorem\n    A formal system (such as a computer program) cannot prove all true statements. Roger Penrose is among those who claim that GÃ¶del''s theorem limits what machines can do.\n\nSearle''s strong AI hypothesis\n    "The appropriately programmed computer with the right inputs and outputs would thereby have a mind in exactly the same sense human beings have minds." John Searle counters this assertion with his Chinese room argument, which asks us to look inside the computer and try to find where the "mind" might be.\n\nThe artificial brain argument\n    The brain can be simulated. Hans Moravec, Ray Kurzweil and others have argued that it is technologically feasible to copy the brain directly into hardware and software, and that such a simulation will be essentially identical to the original.\n\nPredictions and ethics\nMain articles: Artificial intelligence in fiction, Ethics of artificial intelligence, Transhumanism, and Technological singularity\n\nArtificial intelligence is a common topic in both science fiction and projections about the future of technology and society. The existence of an artificial intelligence that rivals human intelligence raises difficult ethical issues, and the potential power of the technology inspires both hopes and fears.\n\nIn fiction, artificial intelligence has appeared fulfilling many roles.\n\nThese include:\n\n    a real time battlefield analyst (Cortana in Halo: Combat Evolved, Halo 2, Halo 3, and Halo 4)\n    a servant (R2-D2 and C-3PO in Star Wars)\n    a law enforcer (K.I.T.T. "Knight Rider")\n    a comrade (Lt. Commander Data in Star Trek: The Next Generation)\n    a conqueror/overlord (The Matrix, Omnius)\n    a dictator (With Folded Hands),(Colossus: The Forbin Project (1970 Movie).\n    a benevolent provider/de facto ruler (The Culture)\n    a supercomputer (The Red Queen in Resident Evil / "Gilium" in Outlaw Star / Golem XIV)\n    an assassin (Terminator)\n    a sentient race (Battlestar Galactica/Transformers/Mass Effect)\n    an extension to human abilities (Ghost in the Shell)\n    the savior of the human race (R. Daneel Olivaw in Isaac Asimov''s Robot series)\n    the human race critic and philosopher (Golem XIV)\n\nMary Shelley''s Frankenstein considers a key issue in the ethics of artificial intelligence: if a machine can be created that has intelligence, could it also feel? If it can feel, does it have the same rights as a human? The idea also appears in modern science fiction, including the films I Robot, Blade Runner and A.I.: Artificial Intelligence, in which humanoid machines have the ability to feel human emotions. This issue, now known as "robot rights", is currently being considered by, for example, California''s Institute for the Future, although many critics believe that the discussion is premature. The subject is profoundly discussed in the 2010 documentary film Plug & Pray.\n\nMartin Ford, author of The Lights in the Tunnel: Automation, Accelerating Technology and the Economy of the Future, and others argue that specialized artificial intelligence applications, robotics and other forms of automation will ultimately result in significant unemployment as machines begin to match and exceed the capability of workers to perform most routine and repetitive jobs. Ford predicts that many knowledge-based occupationsâ€”and in particular entry level jobsâ€”will be increasingly susceptible to automation via expert systems, machine learning and other AI-enhanced applications. AI-based applications may also be used to amplify the capabilities of low-wage offshore workers, making it more feasible to outsource knowledge work.\n\nJoseph Weizenbaum wrote that AI applications can not, by definition, successfully simulate genuine human empathy and that the use of AI technology in fields such as customer service or psychotherapy was deeply misguided. Weizenbaum was also bothered that AI researchers (and some philosophers) were willing to view the human mind as nothing more than a computer program (a position now known as computationalism). To Weizenbaum these points suggest that AI research devalues human life.\n\nMany futurists believe that artificial intelligence will ultimately transcend the limits of progress. Ray Kurzweil has used Moore''s law (which describes the relentless exponential improvement in digital technology) to calculate that desktop computers will have the same processing power as human brains by the year 2029. He also predicts that by 2045 artificial intelligence will reach a point where it is able to improve itself at a rate that far exceeds anything conceivable in the past, a scenario that science fiction writer Vernor Vinge named the "singularity".\n\nRobot designer Hans Moravec, cyberneticist Kevin Warwick and inventor Ray Kurzweil have predicted that humans and machines will merge in the future into cyborgs that are more capable and powerful than either.[185] This idea, called transhumanism, which has roots in Aldous Huxley and Robert Ettinger, has been illustrated in fiction as well, for example in the manga Ghost in the Shell and the science-fiction series Dune. In the 1980s artist Hajime Sorayama''s Sexy Robots series were painted and published in Japan depicting the actual organic human form with life-like muscular metallic skins and later "the Gynoids" book followed that was used by or influenced movie makers including George Lucas and other creatives. Sorayama never considered these organic robots to be real part of nature but always unnatural product of the human mind, a fantasy existing in the mind even when realized in actual form. Almost 20 years later, the first AI robotic pet, AIBO, came available as a companion to people. AIBO grew out of Sony''s Computer Science Laboratory (CSL). Famed engineer Toshitada Doi is credited as AIBO''s original progenitor: in 1994 he had started work on robots with artificial intelligence expert Masahiro Fujita, at CSL. Doi''s, friend, the artist Hajime Sorayama, was enlisted to create the initial designs for the AIBO''s body. Those designs are now part of the permanent collections of Museum of Modern Art and the Smithsonian Institution, with later versions of AIBO being used in studies in Carnegie Mellon University. In 2006, AIBO was added into Carnegie Mellon University''s "Robot Hall of Fame".\n\nPolitical scientist Charles T. Rubin believes that AI can be neither designed nor guaranteed to be friendly. He argues that "any sufficiently advanced benevolence may be indistinguishable from malevolence." Humans should not assume machines or robots would treat us favorably, because there is no a priori reason to believe that they would be sympathetic to our system of morality, which has evolved along with our particular biology (which AIs would not share).\n\nEdward Fredkin argues that "artificial intelligence is the next stage in evolution", an idea first proposed by Samuel Butler''s "Darwin among the Machines" (1863), and expanded upon by George Dyson in his book of the same name in 1998.');
INSERT INTO `lectures` (`lecture_id`, `subject_id`, `topic`, `content`) VALUES
(3, 3, 'Statistics', 'Statistics is the study of the collection, organization, analysis, interpretation and presentation of data. It deals with all aspects of data including the planning of data collection in terms of the design of surveys and experiments.\nMore probability density is found as one gets closer to the expected (mean) value in a normal distribution. Statistics used in standardized testing assessment are shown. The scales include standard deviations, cumulative percentages, percentile equivalents, Z-scores, T-scores, standard nines, and percentages in standard nines.\n\nScope\n\nStatistics is described as a mathematical body of science that pertains to the collection, analysis, interpretation or explanation, and presentation of data,[2] or as a branch of mathematics[3] concerned with collecting and interpreting data. Because of its empirical roots and its focus on applications, statistics is typically considered a distinct mathematical science rather than as a branch of mathematics.[4][5] Some tasks a statistician may involve are less mathematical; for example, ensuring that data collection is undertaken in a way that produces valid conclusions, coding data, or reporting results in ways comprehensible to those who must use them.\n\nStatisticians improve data quality by developing specific experiment designs and survey samples. Statistics itself also provides tools for prediction and forecasting the use of data through statistical models. Statistics is applicable to a wide variety of academic disciplines, including natural and social sciences, government, and business. Statistical consultants can help organizations and companies that don''t have in-house expertise relevant to their particular questions.\n\nStatistical methods can summarize or describe a collection of data. This is called descriptive statistics. This is particularly useful in communicating the results of experiments and research. In addition, data patterns may be modeled in a way that accounts for randomness and uncertainty in the observations.\n\nThese models can be used to draw inferences about the process or population under studyâ€”a practice called inferential statistics. Inference is a vital element of scientific advance, since it provides a way to draw conclusions from data that are subject to random variation. To prove the propositions being investigated further, the conclusions are tested as well, as part of the scientific method. Descriptive statistics and analysis of the new data tend to provide more information as to the truth of the proposition.\n\n"Applied statistics" comprises descriptive statistics and the application of inferential statistics.[6][verification needed] Theoretical statistics concerns both the logical arguments underlying justification of approaches to statistical inference, as well encompassing mathematical statistics. Mathematical statistics includes not only the manipulation of probability distributions necessary for deriving results related to methods of estimation and inference, but also various aspects of computational statistics and the design of experiments.\n\nStatistics is closely related to probability theory, with which it is often grouped. The difference is, roughly, that probability theory starts from the given parameters of a total population to deduce probabilities that pertain to samples. Statistical inference, however, moves in the opposite directionâ€”inductively inferring from samples to the parameters of a larger or total population. Statistics has many ties to machine learning and data mining.Scope[edit]\n\nStatistics is described as a mathematical body of science that pertains to the collection, analysis, interpretation or explanation, and presentation of data,[2] or as a branch of mathematics[3] concerned with collecting and interpreting data. Because of its empirical roots and its focus on applications, statistics is typically considered a distinct mathematical science rather than as a branch of mathematics.[4][5] Some tasks a statistician may involve are less mathematical; for example, ensuring that data collection is undertaken in a way that produces valid conclusions, coding data, or reporting results in ways comprehensible to those who must use them.\n\nStatisticians improve data quality by developing specific experiment designs and survey samples. Statistics itself also provides tools for prediction and forecasting the use of data through statistical models. Statistics is applicable to a wide variety of academic disciplines, including natural and social sciences, government, and business. Statistical consultants can help organizations and companies that don''t have in-house expertise relevant to their particular questions.\n\nStatistical methods can summarize or describe a collection of data. This is called descriptive statistics. This is particularly useful in communicating the results of experiments and research. In addition, data patterns may be modeled in a way that accounts for randomness and uncertainty in the observations.\n\nThese models can be used to draw inferences about the process or population under studyâ€”a practice called inferential statistics. Inference is a vital element of scientific advance, since it provides a way to draw conclusions from data that are subject to random variation. To prove the propositions being investigated further, the conclusions are tested as well, as part of the scientific method. Descriptive statistics and analysis of the new data tend to provide more information as to the truth of the proposition.\n\n"Applied statistics" comprises descriptive statistics and the application of inferential statistics.[6][verification needed] Theoretical statistics concerns both the logical arguments underlying justification of approaches to statistical inference, as well encompassing mathematical statistics. Mathematical statistics includes not only the manipulation of probability distributions necessary for deriving results related to methods of estimation and inference, but also various aspects of computational statistics and the design of experiments.\n\nStatistics is closely related to probability theory, with which it is often grouped. The difference is, roughly, that probability theory starts from the given parameters of a total population to deduce probabilities that pertain to samples. Statistical inference, however, moves in the opposite directionâ€”inductively inferring from samples to the parameters of a larger or total population. Statistics has many ties to machine learning and data mining.\n');

-- --------------------------------------------------------

--
-- Table structure for table `note_topics`
--

CREATE TABLE IF NOT EXISTS `note_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `note_topics`
--

INSERT INTO `note_topics` (`topic_id`, `topic`) VALUES
(1, 'Figures Of Speech'),
(2, 'Programming Languages'),
(3, 'Solar System');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE IF NOT EXISTS `passwords` (
  `intended_to` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`intended_to`, `password`) VALUES
('accessing dictionary', '*41D74B0BC91AF9594B6A7576DF09795C4D69CE35');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(1000) DEFAULT NULL,
  `post_time` varchar(10) DEFAULT NULL,
  `post_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `post_time`, `post_date`) VALUES
(115, 'During my 18th birthday. :) Thank you Ate Yang!', '03:36 AM', 'March 26, 2014'),
(116, 'By Sir Tristan', '06:06 AM', 'March 28, 2014'),
(117, 'Cutie me', '10:09 PM', 'March 28, 2014'),
(118, 'automatically display :)', '10:17 PM', 'March 28, 2014');

-- --------------------------------------------------------

--
-- Table structure for table `posts_comments`
--

CREATE TABLE IF NOT EXISTS `posts_comments` (
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts_files`
--

CREATE TABLE IF NOT EXISTS `posts_files` (
  `post_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  KEY `file_id` (`file_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_files`
--

INSERT INTO `posts_files` (`post_id`, `file_id`) VALUES
(115, 7),
(116, 14),
(117, 15),
(118, 16);

-- --------------------------------------------------------

--
-- Table structure for table `posts_liked`
--

CREATE TABLE IF NOT EXISTS `posts_liked` (
  `liked_by_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  KEY `liked_by_id` (`liked_by_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scratch_data`
--

CREATE TABLE IF NOT EXISTS `scratch_data` (
  `scratch_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `scratch_data` mediumtext,
  `time_added` time DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  PRIMARY KEY (`scratch_data_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `scratch_data`
--

INSERT INTO `scratch_data` (`scratch_data_id`, `scratch_data`, `time_added`, `date_added`) VALUES
(1, 'Accronyms\n\nPHP - PHP Hypertext Preprocessor\nPEPT - Philippine Educational Placement Test\nALS - Alternative Learning System\nCHED - Commission on Higher Education\nTIP - Technological Institute of the Philippines\nIMO - Interntional Maritime Organization\nPACUCOA - Philippine Association of Colleges and Universities Commission on Accreditation\nPTC - ACBET - EAC - Philippine Technological Council-Accreditation and Certification Board for Engineering and Technology - Engineering Accreditation Commission\nOBE - Outcomes-Based Education\nTLAs - Teaching and Learning Activities\nILOs - Intended Learning Outcomes\nOBTL - Outcomes-Based Teaching and Learning\nCOE - Center Of Excellence\nITE - Information Technology Education\nQMS - Quality Management System\nDNV - Det Norske Veritas\nFAAP-PACUCOA - Federation of Accrediting Agencies of the Philippines - Philippine Association of Colleges and Universities Commission on Accreditation\nGWA - General Weighted Average\nNSO - National Statistics Office\nDepEd - Department of Education\nBALS - Bureau of Alternative Learning System\nGPA - Grade Point Average\nNSTP - National Service Training Program\nCAC - Computing Accreditaion Commission\n\n', '23:20:36', '2014-04-08'),
(2, 'Orientation ug contract signing na on April 28, 2014. :)\nSa WGP Hall, Science Education Institute, DOST Compound, Bicutan, Taguig City.', '00:23:43', '2014-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject`) VALUES
(1, 'English'),
(2, 'Filipino'),
(3, 'Mathematics'),
(4, 'Physics'),
(5, 'Biology'),
(6, 'Chemistry'),
(7, 'Science'),
(8, 'Computer Science'),
(9, 'Social Science'),
(10, 'Comouter Science');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(40) DEFAULT NULL,
  `firstname` varchar(40) DEFAULT NULL,
  `middlename` varchar(40) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `educational_level` varchar(12) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `year_level` varchar(10) DEFAULT NULL,
  `college_course` varchar(100) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `adviser` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lastname`, `firstname`, `middlename`, `birthday`, `address`, `educational_level`, `school_name`, `year_level`, `college_course`, `section`, `adviser`) VALUES
(101, 'Perpinosa', 'Marejean', 'Granaderos', '1996-02-15', 'Brgy. Pinagkaisahan Cubao, Quezon City', 'College', 'University of the Philippines', '1st year', 'Computer Science', 'first section', 'Prof Gilbert Carilla');

-- --------------------------------------------------------

--
-- Table structure for table `users_accounts`
--

CREATE TABLE IF NOT EXISTS `users_accounts` (
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  KEY `user_account_to_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_accounts`
--

INSERT INTO `users_accounts` (`user_id`, `username`, `password`) VALUES
(101, 'JavaScript', 'marjiecasosa');

-- --------------------------------------------------------

--
-- Table structure for table `users_alarms`
--

CREATE TABLE IF NOT EXISTS `users_alarms` (
  `user_id` int(11) DEFAULT NULL,
  `alarm_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `alarm_id` (`alarm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_alarms`
--

INSERT INTO `users_alarms` (`user_id`, `alarm_id`, `status`) VALUES
(101, 91, 1),
(101, 94, 1),
(101, 95, 1),
(101, 96, 1),
(101, 99, 1),
(101, 100, 1),
(101, 101, 1),
(101, 102, 1),
(101, 103, 1),
(101, 104, 1),
(101, 105, 1),
(101, 106, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_assignments`
--

CREATE TABLE IF NOT EXISTS `users_assignments` (
  `user_id` int(11) DEFAULT NULL,
  `assignment_detail_id` int(11) DEFAULT NULL,
  KEY `user_id_foreign_key_in_users_assignments` (`user_id`),
  KEY `assignment_detail_id_in_users_assignments` (`assignment_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_assignments`
--

INSERT INTO `users_assignments` (`user_id`, `assignment_detail_id`) VALUES
(101, 4),
(101, 5),
(101, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users_class_schedules`
--

CREATE TABLE IF NOT EXISTS `users_class_schedules` (
  `user_id` int(11) DEFAULT NULL,
  `cs_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `cs_id` (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_dictionary`
--

CREATE TABLE IF NOT EXISTS `users_dictionary` (
  `user_id` int(11) DEFAULT NULL,
  `dictionary_id` int(11) DEFAULT NULL,
  KEY `user_id_foreign_key` (`user_id`),
  KEY `dictionary_id_foreign_key` (`dictionary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_dictionary`
--

INSERT INTO `users_dictionary` (`user_id`, `dictionary_id`) VALUES
(101, 8),
(101, 9),
(101, 10),
(101, 11),
(101, 12),
(101, 13),
(101, 14),
(101, 15),
(101, 16),
(101, 17),
(101, 18),
(101, 19),
(101, 20),
(101, 21),
(101, 22),
(101, 23),
(101, 24),
(101, 25),
(101, 26),
(101, 27),
(101, 28),
(101, 29),
(101, 30),
(101, 31),
(101, 32),
(101, 33),
(101, 34),
(101, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users_lectures`
--

CREATE TABLE IF NOT EXISTS `users_lectures` (
  `user_id` int(11) DEFAULT NULL,
  `lecture_id` int(11) DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `lecture_id_foreign_key` (`lecture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_lectures`
--

INSERT INTO `users_lectures` (`user_id`, `lecture_id`, `added_time`, `added_date`) VALUES
(101, 1, '22:42:48', '2014-03-30'),
(101, 2, '23:16:17', '2014-03-30'),
(101, 3, '19:07:44', '2014-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `users_posts`
--

CREATE TABLE IF NOT EXISTS `users_posts` (
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_posts`
--

INSERT INTO `users_posts` (`user_id`, `post_id`) VALUES
(101, 115),
(101, 116),
(101, 117),
(101, 118);

-- --------------------------------------------------------

--
-- Table structure for table `users_profile_images`
--

CREATE TABLE IF NOT EXISTS `users_profile_images` (
  `user_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_profile_images`
--

INSERT INTO `users_profile_images` (`user_id`, `image_id`) VALUES
(101, 0),
(101, 8),
(101, 9),
(101, 10),
(101, 11),
(101, 12),
(101, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users_scratch_data`
--

CREATE TABLE IF NOT EXISTS `users_scratch_data` (
  `user_id` int(11) DEFAULT NULL,
  `scratch_data_id` int(11) DEFAULT NULL,
  KEY `user_id_foreign_key_in_users_scratch_data` (`user_id`),
  KEY `scratch_data_id_in_users_scratch_data` (`scratch_data_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_scratch_data`
--

INSERT INTO `users_scratch_data` (`user_id`, `scratch_data_id`) VALUES
(101, 1),
(101, 2);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `word_id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`word_id`, `word`) VALUES
(1, 'grid system'),
(2, 'data transmission'),
(3, 'digital transmission'),
(4, 'digital communications'),
(5, 'computer science'),
(6, 'abstract'),
(7, 'wizard'),
(8, 'American Standard Code for Information Interchange'),
(9, 'combinatorics'),
(10, 'mathematics'),
(11, 'Alan Mathison Turing'),
(12, 'mathematical logic'),
(13, 'Rene Descartes'),
(14, 'Artificial Intelligent'),
(15, 'machine translation'),
(16, 'computational linguistics'),
(17, 'linguistics'),
(18, 'philology'),
(19, 'dialectology'),
(20, 'computer'),
(21, 'Mutexes'),
(22, 'SEM'),
(23, 'scanning electron microscope'),
(24, 'LTTE'),
(25, 'Liberation Tigers of Tamil Eelam'),
(26, 'time stamp');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarms`
--
ALTER TABLE `alarms`
  ADD CONSTRAINT `alarms_ibfk_1` FOREIGN KEY (`tone_id`) REFERENCES `alarm_tones` (`tone_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `item_id_foreign_key_in_assignments` FOREIGN KEY (`item_id`) REFERENCES `assignment_items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_detail_id_in_assignments` FOREIGN KEY (`assignment_detail_id`) REFERENCES `assignment_details` (`assignment_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment_details`
--
ALTER TABLE `assignment_details`
  ADD CONSTRAINT `subject_id_foreign_key_in_assignment_details` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_id_foreign_key_in_assingment_details` FOREIGN KEY (`topic_id`) REFERENCES `note_topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD CONSTRAINT `class_schedules_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `days` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD CONSTRAINT `definition_id_foreign_key` FOREIGN KEY (`definition_id`) REFERENCES `definitions` (`definition_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `word_id_foreign_key` FOREIGN KEY (`word_id`) REFERENCES `words` (`word_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `subject_id_foreign_key` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD CONSTRAINT `posts_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_comments_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts_files`
--
ALTER TABLE `posts_files`
  ADD CONSTRAINT `posts_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_files_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts_liked`
--
ALTER TABLE `posts_liked`
  ADD CONSTRAINT `posts_liked_ibfk_1` FOREIGN KEY (`liked_by_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_liked_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_accounts`
--
ALTER TABLE `users_accounts`
  ADD CONSTRAINT `user_account_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_alarms`
--
ALTER TABLE `users_alarms`
  ADD CONSTRAINT `users_alarms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_alarms_ibfk_2` FOREIGN KEY (`alarm_id`) REFERENCES `alarms` (`alarm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_assignments`
--
ALTER TABLE `users_assignments`
  ADD CONSTRAINT `assignment_detail_id_in_users_assignments` FOREIGN KEY (`assignment_detail_id`) REFERENCES `assignment_details` (`assignment_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign_key_in_users_assignments` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_class_schedules`
--
ALTER TABLE `users_class_schedules`
  ADD CONSTRAINT `users_class_schedules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_class_schedules_ibfk_2` FOREIGN KEY (`cs_id`) REFERENCES `class_schedules` (`cs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_dictionary`
--
ALTER TABLE `users_dictionary`
  ADD CONSTRAINT `dictionary_id_foreign_key` FOREIGN KEY (`dictionary_id`) REFERENCES `dictionary` (`dictionary_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_lectures`
--
ALTER TABLE `users_lectures`
  ADD CONSTRAINT `lecture_id_foreign_key` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_lectures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD CONSTRAINT `users_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_posts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_profile_images`
--
ALTER TABLE `users_profile_images`
  ADD CONSTRAINT `users_profile_images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_scratch_data`
--
ALTER TABLE `users_scratch_data`
  ADD CONSTRAINT `scratch_data_id_in_users_scratch_data` FOREIGN KEY (`scratch_data_id`) REFERENCES `scratch_data` (`scratch_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign_key_in_users_scratch_data` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
