ci-keyword-generator
====================

CodeIgniter Library for generating META keywords for pages / site content

How to Use
----------

**Place the library into your libraries folder:**  

    /application/libraries/Metakeywords.php
  
**Load the library in your controller:**  

    $this->load->library( 'Metakeywords' );
  
**Using a paragraph of $text, have it generate a comma seperated string of keywords:**   

    echo $this->metakeywords->get( $text );
  