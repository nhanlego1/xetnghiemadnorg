jQuery(document).ready(function($)
{
	$('#lead_feature_box').hide();
	$('#standard_lead').hide();
	$('#column_lead').hide();
	$('#full_lead').hide();
	$('#table_lead').hide();
	$('#orb_lead').hide();

	// feature box
	$('#feature_box_lead').is(':checked') ? $("#lead_feature_box").show() : $("#lead_feature_box").hide();
	$('#feature_box_lead').click(function()
	{
		$("#lead_feature_box").toggle(this.checked);
		$('#standard_lead').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});

	// standard lead
	$('#standard_box_lead').is(':checked') ? $("#standard_lead").show() : $("#standard_lead").hide();
	$('#standard_box_lead').click(function()
	{
		$("#standard_lead").toggle(this.checked);
		$('#lead_feature_box').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});

	// column lead
	$('#column_box_lead').is(':checked') ? $("#column_lead").show() : $("#column_lead").hide();
	$('#column_box_lead').click(function()
	{
		$("#column_lead").toggle(this.checked);
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});

	// full lead
	$('#full_width_lead').is(':checked') ? $("#full_lead").show() : $("#full_lead").hide();
	$('#full_width_lead').click(function()
	{
		$("#full_lead").toggle(this.checked);
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#column_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});

	// table lead
	$('#table_chart_lead').is(':checked') ? $("#table_lead").show() : $("#table_lead").hide();
	$('#table_chart_lead').click(function()
	{
		$("#table_lead").toggle(this.checked);
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#orb_lead').hide();
	});

	// orb lead
$('#orb_area_lead').is(':checked') ? $("#orb_lead").show() : $("#orb_lead").hide();
	$('#orb_area_lead').click(function()
	{
		$("#orb_lead").toggle(this.checked);
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide();
	});

	// if nothing is selected
	$('#no_lead').click(function()
	{
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});

	// landing page
	$('#landing_page_template').click(function()
	{
		$('#lead_feature_box').hide(); $('#standard_lead').hide(); $('#column_lead').hide(); $('#full_lead').hide(); $('#table_lead').hide(); $('#orb_lead').hide();
	});
});
