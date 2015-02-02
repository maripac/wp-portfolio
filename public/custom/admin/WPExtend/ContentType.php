<?php
/**
 * The functionality for proper formatting of labels when creating and registrating new custom post types.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
namespace WPPlugins\WPExtend;
/**
 * Definition of class ContentType provides formatting to easily instantiate a new post type.
 *
 * This Class provides support and is needed by *bootstrap.php*. It defines the properties and methods
 * that especify which values must be provided in order to instantiate an object from the current class.
 * The ContentType class does not create any post type by default. It rather provides support for creating
 * new post types without having to define for each new post type long register methods.   
 *
 * Basic class definitions begin with the keyword class, followed by a class name, 
 * followed by a pair of curly braces which enclose the definitions of the properties 
 * and methods belonging to the class.
 *
 * Class member variables are called "properties".
 * Though class properties do not need an initial value, sometimes the
 * property might be initialised right away after its declaration. 
 * Properties can be declared as public, protected or private.  
 * Which refers to its visibility:
 * 1. private may only be accessed by the class that defines the member.
 * 2. protected may be accessed by class itself, by inherited classes and by parent classes.
 * 3. public may be accessed everywhere. 
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

 class ContentType 
 {
    /**
	 * Creates a new ContentType Class
	 * @param string $type
	 * @param array $options
	 * @param array $labels
	 */

    /**
     * @var string $type Should contain a name
     */
     public $type;
    /**
     * @var array $options Should contain a list of parameters required in order to register the new post type
     */
     public $options = [];
    /**
     * @var array $labels Should contain a list of parameters required in order to register the new post type
     */
     public $labels = [];

	/**
	 * Using Constructors and Destructors.
	 *
	 * When an object is instantiated, it’s often desirable to set a few
	 * things right off the bat. To handle this, PHP provides the magic
	 * __construct(), method which is called automatically whenever a new object is created.
	 *
	 * The constructor takes three arguments: a string name for the post type, an array containing the list of options 
	 * that the post type must support and a third argument labels that retrieves the singular and plural name 
	 * values provided when an object is instantiated from the current class, and takes care of returning the syntax needed for proper
	 * treatment of CMS labeling of messages such as Add New *singular_name*, and No *plural_name* found in Trash.
	 *
	 * @param string $type Name you want to process.
	 * @param array $options List of post types that will make use of $type. 
	 * @param array $labels List of options.
	 * the messages template obtained by declaring a variable default_labels. 
	 */
	 public function __construct($type, $options = [], $labels = []) {
	 // OOP allows objects to reference themselves using $this. When working within a method,
	 // use $this in the same way you would use the object name outside the class.
	 $this->type = $type;

	 $default_options = [
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'hierarchical'       => true,
		'query_var' => true,
		'supports' => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments']
	 ];
	 $required_labels = [
		'singular_name' => ucwords($this->type),
		'plural_name' => ucwords($this->type)
	 ];

	 $this->options = $options + $default_options;
	 $this->labels = $labels + $required_labels;
	 // Now we have made the modifications needed on the Class Properties, 
	 // But the $labels property has not been placed back in the $options array

	 $this->options['labels'] = $this->labels + $this->default_labels();


	 // add an action. Instead of passing a function inline, 
	 // we are going to use a different kind of callable, that passes an object and a string that points to a method.
	 add_action( 'init', array($this, "register"));
	 }
	 /**
	 * Final reordering of the previously retrieved property values for initialising the hook to 
	 * register the new post type.
	 *
	 * class-specific variables, work exactly like regular variables,
	 * except they’re bound to the object and therefore can only be
	 * accessed using the object. To read this property and output
	 * it to the browser, reference the object from which to read the property: echo $obj->prop1.
	 *
	 * OOP allows objects to reference themselves using $this. When working within a method,
	 * use $this in the same way you would use the object name outside the class.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 * @param string $type Name you want to process.
	 * @param array $options List of post types that will make use of $taxonomy. 
	 * @param array $labels List of options containing the returned values of labels.
	 */

	 public function register() {
	 	register_post_type($this->type, $this->options);
	 }

	 /**
	  * Labels default template for new post types.
	  * 
	  * Initialises a function that returns an array of values for the variable default_labels 
	  * declared inside the constructor method.
	  *
	  * @link http://codex.wordpress.org/Function_Reference/register_post_type
	  */
	 public function default_labels() {
		return [
			'name'                       => $this->labels['plural_name'],
            'singular_name'              => $this->labels['singular_name'],
            'add_new'                    => 'Add New ' . $this->labels['singular_name'],
            'add_new_item'               => 'Add New ' . $this->labels['singular_name'],
            'edit_item'					 => 'Edit ' . $this->labels['singular_name'],
            'new_item'					 => 'New ' . $this->labels['singular_name'],
            'all_items'					 => 'All ' . $this->labels['plural_name'],
            'view_item'					 => 'View ' . $this->labels['singular_name'],
            'search_items'				 => 'Search ' . $this->labels['plural_name'],
            'not_found'        			 => 'No matching ' . strtolower($this->labels['plural_name']) . ' found',
            'not_found_in_trash'         => 'No ' . strtolower($this->labels['plural_name']) . ' found in Trash',
            'parent_item_colon'          => 'Parent ' . $this->labels['singular_name'],
            'menu_name'                  => $this->labels['plural_name']
		];
	 }	
 }