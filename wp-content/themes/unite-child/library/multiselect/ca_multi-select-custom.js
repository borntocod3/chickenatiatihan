jQuery(document).ready(function($){
	/*
		Multiselect initialization
	*/
	$('.ca_multi-select').multiselect();

	
    var optgroups = [
        {
            label: 'Group 1', children: [
                {label: 'Option 1.1', value: '1-1', selected: true},
                {label: 'Option 1.2', value: '1-2'},
                {label: 'Option 1.3', value: '1-3'}
            ]
        },
        {
            label: 'Group 2', children: [
                {label: 'Option 2.1', value: '1'},
                {label: 'Option 2.2', value: '2'},
                {label: 'Option 2.3', value: '3', disabled: true}
            ]
        }
    ];
    $('#example-dataprovider-optgroups').multiselect('dataprovider', optgroups);
});