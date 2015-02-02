<?php
/**
 * The functionality for proper formatting of labels when creating and registrating new taxonomies.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
namespace WPPlugins\WPExtend;
/**
 * Definition of class ContentTax provides formatting to easily instantiate a new taxonomy.
 *
 * This Class provides support and is needed by *bootstrap.php*. It defines the properties and methods
 * that especify which values must be provided in order to instantiate an object from the current class.
 * The ContentTax class does not create any taxonomy by default. It rather provides support for creating
 * new taxonomies without having to define for each new taxonomy long register methods.   
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
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

class ContentTax
{
   /**
    * @var string $taxonomy Should contain a name
    */
	public $taxonomy;
   /**
    * @var array $object_type Should contain a list of supported post types
    */
	public $object_type = [];
   /**
    * @var array $args Should contain a list of parameters in order to register the new taxonomy
    */
	public $args = [];
   /**
    * @var array $labels Should provide at least a value either singular_name or plural_name 
    * understanding that if added to the string that's been asigned to the new taxonomy these 
    * two values should provide the required pair for singular and plural.
    */
	public $labels = [];

	/**
	 * Using Constructors and Destructors.
	 *
	 * When an object is instantiated, it’s often desirable to set a few
	 * things right off the bat. To handle this, PHP provides the magic
	 * __construct(), method which is called automatically whenever a new object is created.
	 *
	 * The construvtor takes four arguments: a string name for the taxonomy, an array containing the list of content types 
	 * that the taxonomy must support and a third argument that provides some custom options such as public
	 * along with some other boolean arguments. Additionaly the labels argument retrieves the singular and plural name 
	 * values provided when an object is instantiated from the current class, and takes care of returning the syntax needed for proper
	 * treatment of CMS labeling of messages such as Add New *singular_name*, and No *plural_name* found in Trash.
	 *
	 * @param string $taxonomy Name you want to process.
	 * @param array $object_type List of post types that will make use of $taxonomy. 
	 * @param array $args List of options.
	 * @param array $labels requires singular_name and plural_name forms for a given taxonomy and maps values into 
	 * the messages template obtained by declaring a variable default_labels. 
	 */
	public function __construct($taxonomy, $object_type = [], $args = [], $labels = []) {

		

		$default_args = [
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column' 		 => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'sort' 						 => true,
		 	'query_var'  => true,
 			'rewrite' => ['slug' => $this->taxonomy],
 			'args' => array( 'orderby' => 'term_order' ), 
 			'hierarchical' => true
 			//=> ['slug' => $this->taxonomy]
 			//'rewrite'	 => $this->taxonomy['slug'] 
 			
 			//=> $this->taxonomy['slug']
 			//'hierarchical' => true,
            //'sort' => true,
            
		];
		$required_labels = [
			'singular_name' => ucwords($this->taxonomy),
			'plural_name' => ucwords($this->taxonomy)
		];
		$default_object_type = [
			$this->object_type
		];

		$this->taxonomy = $taxonomy;
		$this->object_type = $object_type + $default_object_type;
		$this->args = $args + $default_args;
		$this->labels = $labels + $required_labels;
		// Now we have made the modifications needed on the Class Properties, 
		// But the $labels property has not been placed back in the $options array

		$this->args['labels'] = $this->labels + $this->default_labels();


		// add an action. Instead of passing a function inline, 
		// we are going to use a different kind of callable, that passes an object 
	    // and a string that points to a method.
		add_action( 'init', array($this, "register"));

	}
	/**
	 * Final reordering of the previously retrieved property values for initialising the hook to 
	 * register the new taxonomy.
	 *
	 * class-specific variables, work exactly like regular variables,
	 * except they’re bound to the object and therefore can only be
	 * accessed using the object. To read this property and output
	 * it to the browser, reference the object from which to read the property: echo $obj->prop1.
	 *
	 * OOP allows objects to reference themselves using $this. When working within a method,
	 * use $this in the same way you would use the object name outside the class.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
	 * @param string $taxonomy Name you want to process.
	 * @param array $object_type List of post types that will make use of $taxonomy. 
	 * @param array $args List of options containing the returned values of labels.
	 */

	public function register() {
		register_taxonomy($this->taxonomy, $this->object_type, $this->args);
	}

	/**
	 * Labels default template for new taxonomies.
	 * 
	 * Initialises a function that returns an array of values for the variable default_labels 
	 * declared inside the constructor method.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy#Example
	 */
	public function default_labels() {
	return [
		'name'                   => $this->labels['plural_name'],
		'singular_name'          => $this->labels['singular_name'],
		'search_items'           => 'Search ' . $this->labels['plural_name'],
		'popular_items'          => 'Popular ' . $this->labels['plural_name'],
		'all_items'              => 'All ' . $this->labels['plural_name'],
		'parent_item'            => 'All Parent ' . $this->labels['plural_name'],
		'parent_item_colon'      => '',
		'edit_item'              => 'Edit ' . $this->labels['singular_name'],
		'update_item'            => 'Update ' . $this->labels['singular_name'],
		'add_new_item'           => 'Add New ' . $this->labels['singular_name'],
		'new_item_name'          => 'New ' . $this->labels['singular_name'],
		'separate_items_with_commas' => 'Separate ' . strtolower($this->labels['plural_name']) . ' commas',
		'add_or_remove_items'        => 'Add or remove ' . $this->labels['plural_name'],
		'choose_from_most_used'      => 'Choose from the most used ' . strtolower($this->labels['plural_name']),
		'not_found'                  => 'No ' . strtolower($this->labels['plural_name']) . ' found',
		'menu_name'                  => $this->labels['plural_name']
		];
	}
}