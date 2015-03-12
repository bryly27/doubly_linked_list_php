<?php 

class Node 
{
	// declare node properties as public
	public $value, $prev, $next;

	// set node's value upon instansiation
	public function __construct($node_value) 
	{
		$this->value = $node_value;
	}
}

class Doubly_linked_node 
{
	// declare variable $head and $tail as public
	public $head, $tail;

	public function __construct($first_value)
	{
		// set default variables values for $head and $tail
		$this->head = new Node($first_value);
		$this->tail = (object) null;
	}

	// function for adding a node
	public function add_node($node_value) 
	{
		// create a new node object
		$new_node = new Node($node_value);

		// if this node has a tail
		if(isset($this->tail->value))
		{
			// set the current tail node's next to the new node
			$this->tail->next = $new_node;
			
			// set the new node's prev to the current tail node
			$new_node->prev = $this->tail;
		}
		// if this node has no tail
		else
		{
			// set the head's next node to be the newly added node
			$this->head->next = $new_node;

			// set the new node's prev to the head node
			$new_node->prev = $this->head;
		}

		// set the newly added node to be the tail node
		$this->tail = $new_node;
	}

	// function for removing a node
	public function remove_node($node_index)
	{
		// store the current node head to $current_node for iteration
		$current_node = $this->head;

		// get the node to be deleted
		$node_to_be_deleted = $this->get_node($node_index);

		// set a counter variable
		$counter = 0;

		// while the $current_node is not null
		while(isset($current_node))
		{
			// if the current $counter value matches the $node_index parameter
			if($counter == ($node_index-1))
			{
				// check if the $current_node's prev is set
				if(isset($current_node->prev))
					$current_node->prev->next = $current_node->next;
				// if the $current_node's prev is not set, we're probably removing the $this->head node
				else
					$this->head = $current_node->next;

				// check if the $current_node's next is set
				if(isset($current_node->next))
					$current_node->next->prev = $current_node->prev;
				// if the $current_node's next is not set, we're probably removing the $this->tail node
				else
					$this->tail = $current_node->prev;

				break;
			}

			$current_node = $current_node->next;
			$counter++;
		}
	}

	// function for inserting a node
	public function insert_node($node_value, $node_index)
	{
		// store the current node head to $current_node for iteration
		$current_node = $this->head;

		// set a counter variable
		$counter = 0;

		// while the $current_node is not null
		while(isset($current_node))
		{
			// if the current $counter value matches the $node_index parameter
			if($counter == ($node_index-1))
			{
				// set new node properties
				$new_node = new Node($node_value);
				$new_node->prev = $current_node->prev;
				$new_node->next = $current_node;

				// check if the $current_node's prev is set
				if(isset($current_node->prev))
				{
					$current_node->prev->next = $new_node;
				}
				// if the $current_node's prev is not set, we're probably removing the $this->head node
				else
					$this->head = $new_node;

				// check if the $current_node's next is set
				if(isset($current_node->next))
				{
					$current_node->next->prev = $new_node;
				}// if the $current_node's next is not set, we're probably removing the $this->tail node
				else
				{
					$new_node->prev = $this->tail;
					$this->tail = $new_node;
				}
			}

			$current_node = $current_node->next;
			$counter++;
		}
	}

	// function to display the linked list contents
	public function display_contents()
	{
		// store the current node head to $current_node for iteration
		$current_node = $this->head;

		// set a counter variable
		$counter = 0;

		// display linked list
		echo "<pre>";

		while(isset($current_node))
		{
			echo "	<strong style='color:brown;'>Node #". ($counter+1) ."</strong> Value: {$current_node->value}<br>
					<hr>";

			$current_node = $current_node->next;
			$counter++;
		}

		echo "</pre>";
		// end of displaying linked list
	}

	// private function to get via index/position in the linked list
	private function get_node($node_index)
	{
		// set $node variable to the current head for iteration
		$node = $this->head;

		// loop based on the $node_index paramter
		for($i=1;$i<$node_index;$i++)
		{
			// set the $node variable to be its next
			$node = $node->next;
		}

		return $node;
	}
}

$new_doubly_linked_node = new Doubly_linked_node(5);
$new_doubly_linked_node->add_node(6);
$new_doubly_linked_node->add_node(7);
$new_doubly_linked_node->add_node(8);
$new_doubly_linked_node->add_node(9);

$new_doubly_linked_node->display_contents();
?>
