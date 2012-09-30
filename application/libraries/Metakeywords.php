<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

   /** 
	*Code based on the original forum post & discussions located on:
	*  - http://www.webdeveloper.com/forum/showthread.php?233298-Functions-to-generate-meta-keywords-based-on-keyword-density&p=1104209
	* 
	* This code was updated to be utilized specifically for CodeIgniter by donjakobo@github
	* modifications were made as per discussion by individuals. All rights / code ideas of their respective parties.
	*/

class Metakeywords {

   /** 
    * This array of words might be stored in a database for ease of update-ability or being more accessible
    */ 	
   private $stopWords = array("a", "about", "above", "above", "across", 
      "after", "afterwards", "again", "against", "all", "almost", "alone", 
      "along", "already", "also", "although", "always", "am", "among", 
      "amongst", "amoungst", "amount", "an", "and", "another", "any", "anyhow", 
      "anyone", "anything", "anyway", "anywhere", "are", "around", "as", "at", 
      "back", "be", "became", "because", "become", "becomes", "becoming", 
      "been", "before", "beforehand", "behind", "being", "below", "beside", 
      "besides", "between", "beyond", "bill", "both", "bottom", "but", "by", 
      "call", "can", "cannot", "cant", "co", "com", "con", "could", "couldn't", 
      "de", "detail", "do", "done", "down", "due", "during", "each", 
      "eg", "eight", "either", "eleven", "else", "elsewhere", "empty", "enough", 
      "etc", "even", "ever", "every", "everyone", "everything", "everywhere", 
      "except", "few", "fifteen", "fify", "fill", "find", "first", 
      "five", "for", "former", "formerly", "forty", "found", "four", "from", 
      "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", 
      "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", 
      "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", 
      "hundred", "i", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", 
      "it", "its", "itself", "keep", "last", "latter", "latterly", "least", 
      "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", 
      "mine", "more", "moreover", "most", "mostly", "move", "much", "must", 
      "my", "myself", "name", "namely", "neither", "never", "nevertheless", 
      "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", 
      "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", 
      "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", 
      "out", "over", "own", "part", "per", "perhaps", "please", "put", "rather", "rd", 
      "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", 
      "several", "she", "should", "show", "side", "since", "sincere", "six", 
      "sixty", "so", "some", "somehow", "someone", "something", "sometime", 
      "sometimes", "somewhere", "still", "such", "take", "ten", 
      "than", "that", "the", "their", "them", "themselves", "then", "thence", 
      "there", "thereafter", "thereby", "therefore", "therein", "thereupon", 
      "these", "they", "thin", "third", "this", "those", "though", 
      "three", "through", "throughout", "thru", "thus", "to", "together", "too", 
      "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", 
      "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", 
      "what", "whatever", "when", "whence", "whenever", "where", "whereafter", 
      "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", 
      "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", 
      "why", "will", "with", "within", "without", "would", "yet", "you", "your", 
      "yours", "yourself", "yourselves", "ll", "t", "s", "d", "ve", "m", 
	  
	  // special oddities
	  "-", "--", "http", "www", "org"
   ); 

   /** 
    * Get a string of keywords
    * @return string 
    * @param string $text 
    * @param int $nbrWords Number of words to return, default = 8 
    */ 
	public function get($text, $nbrWords = 8) { 
		$text = strtolower(strip_tags($text));
		$keywords = $this->getKeywords($text, $nbrWords); 
		return implode(", ", $keywords);
	}	
	
   /** 
    * Get array of keywords
    * @return array 
    * @param string $text 
    * @param int $nbrWords Number of words to return, default = 8 
    */ 
	public function getKeywords($text, $nbrWords = 8) { 

		$text = preg_replace('/\'\w*\b/',' ',$text); // both contractions and possessives
		$words = str_word_count($text, 1); 
		
		array_walk($words, array( $this, 'filter' )); 		
		$words = array_diff($words, $this->stopWords); 
		$wordCount = array_count_values($words); 
		
		arsort($wordCount); 
		$wordCount = array_slice($wordCount, 0, $nbrWords); 
		
		return array_keys($wordCount); 
	} 
   
	private function filter(&$val, $key) { 
      $val = strtolower($val); 
	} 
   
	private function setStopWords() { 
      $this->stopWords = array(); 
	} 
	
}

/* End of file /application/libraries/Metakeywords.php */