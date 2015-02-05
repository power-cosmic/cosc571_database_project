<?php
function create_state_dropdown($select_name='state', $type='mixed') {
	$state_dropdown = "\n" . '<select name="' . $select_name . '">' . "\n";
	$state_dropdown .= create_state_dropdown_options($type);
	$state_dropdown .= '</select>' . "\n";
	return $state_dropdown;
}

function create_state_dropdown_options($type='mixed') {
	$states = array(
		'AK' => 'Alaska',
		'AL' => 'Alabama',
		'AR' => 'Arkansas',
		'AZ' => 'Arizona',
		'CA' => 'California',
		'CO' => 'Colorado',
		'CT' => 'Connecticut',
		'DC' => 'District of Columbia',
		'DE' => 'Delaware',
		'FL' => 'Florida',
		'GA' => 'Georgia',
		'HI' => 'Hawaii',
		'IA' => 'Iowa',
		'ID' => 'Idaho',
		'IL' => 'Illinois',
		'IN' => 'Indiana',
		'KS' => 'Kansas',
		'KY' => 'Kentucky',
		'LA' => 'Louisiana',
		'MA' => 'Massachusetts',
		'MD' => 'Maryland',
		'ME' => 'Maine',
		'MI' => 'Michigan',
		'MN' => 'Minnesota',
		'MO' => 'Missouri',
		'MS' => 'Mississippi',
		'MT' => 'Montana',
		'NC' => 'North Carolina',
		'ND' => 'North Dakota',
		'NE' => 'Nebraska',
		'NH' => 'New Hampshire',
		'NJ' => 'New Jersey',
		'NM' => 'New Mexico',
		'NV' => 'Nevada',
		'NY' => 'New York',
		'OH' => 'Ohio',
		'OK' => 'Oklahoma',
		'OR' => 'Oregon',
		'PA' => 'Pennsylvania',
		'PR' => 'Puerto Rico',
		'RI' => 'Rhode Island',
		'SC' => 'South Carolina',
		'SD' => 'South Dakota',
		'TN' => 'Tennessee',
		'TX' => 'Texas',
		'UT' => 'Utah',
		'VA' => 'Virginia',
		'VT' => 'Vermont',
		'WA' => 'Washington',
		'WI' => 'Wisconsin',
		'WV' => 'West Virginia',
		'WY' => 'Wyoming'
	);
	
	$options = '<option value="" selected disabled></option>' . "\n";
	
	foreach ($states as $abbrev=>$name) {
		switch ($type) {
			case 'abbrev':
				$value = $abbrev;
				$display = $abbrev;
				break;
			case 'name':
				$value = $name;
				$display = $name;
				break;
			case 'mixed':
			default:
				$value = $abbrev;
				$display = $name;
				break;
		}
		
		$options .= '<option value="' . $value . '">' . $display . '</option>' . "\n";
	}
		
	return $options;
}
?>