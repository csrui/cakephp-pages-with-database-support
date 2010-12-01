<?php
class PagesPage extends PagesAppModel 
{

    var $useTable = 'pages';
    
    var $actsAs = array('Sluggable'=>array('label'=>'title'));
	
	var $validate = array(
        'slug'=>array(
            'Please use only letters, numbers, dashes or underscores'=>array(
                'rule'=> 'alphaNumericDashUnderscore'
            ),
            'This slug is already taken, please try another'=>array(
                'rule'=>'isUnique' #TODO Need a Custom validation. Needs to be Unique within the same language
            )),
        'language'=>array(
            'Plase provide a 3 char language code'=>array(
                'rule'=>array('minLength', 3)
            )),
        'body'=>array(
            'The page body must have some content'=>array(
                'rule'=> 'notEmpty'
            )
        )
    );

}
?>
