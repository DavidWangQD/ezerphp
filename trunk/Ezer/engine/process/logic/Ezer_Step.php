<?php
/**
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please send
 * e-mail to tan-tan@simple.co.il
 */


require_once dirname(__FILE__) . '/../case/Ezer_StepInstance.php';


/**
 * Purpose:     Enum for join policies
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_StepJoinPolicy
{
	const JOIN_AND = 1;
	const JOIN_OR = 2;
}

/**
 * Purpose:     Store in the memory the definitions of a step
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_Step
{
	public $id;
	protected $name;
	protected $join_policy = Ezer_StepJoinPolicy::JOIN_AND;
	protected $max_retries = 1;
	protected $priority = 1;
	protected $targets = array();
	protected $sources = array();
	
	public $in_flows = array();
	public $out_flows = array();
	
	public function __construct($id)
	{
		$this->id = $id;
	}

	public abstract function &createInstance(Ezer_ScopeInstance &$scope_instance);

	public function getName()
	{
		return $this->name; 
	}
	
	public function setName($name)
	{
		$this->name = $name; 
	}
	
	public function addTarget(Ezer_Link $target)
	{
		$this->targets[] = $target;
	}
	
	public function addSource(Ezer_Link $source)
	{
		$this->sources[] = $source;
	}
	
	public function getMaxRetries()
	{
		return $this->max_retries; 
	}
	
	public function getJoinPolicy()
	{
		return $this->join_policy; 
	}
	
	public function getPriority()
	{
		return $this->priority; 
	}
	
	public function getTargets()
	{
		return $this->targets; 
	}
	
	public function getSources()
	{
		return $this->sources; 
	}
	
	public function getOutFlows()
	{
		return $this->out_flows;
	}
	
	public function setOutFlow(Ezer_Step &$step)
	{
		if(!isset($this->out_flows[$step->id]))
		{
			$this->out_flows[$step->id] = $step;
//			echo "flow " . $this->getName() . " => " . $step->getName() . "\n";
		} 
	}
	
	public function setInFlow(Ezer_Step &$step)
	{
		if(!isset($this->in_flows[$step->id]))
		{
			$this->in_flows[$step->id] = $step;
//			echo "flow " . $step->getName() . " => " . $this->getName() . "\n";
		} 
	}
}

?>