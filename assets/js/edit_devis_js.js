//create our editable grid
var editableGrid = new EditableGrid("DemoGridFull", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"

	maxBars: 10
});

//helper function to display a message
function displayMessage(text, style) { 
	_$("message").innerHTML = "<p class='" + (style || "ok") + "'>" + text + "</p>"; 
} 

//helper function to get path of a demo image
function image(relativePath) {
	return "images/" + relativePath;
}

//this will be used to render our table headers
function InfoHeaderRenderer(message) { 
	this.message = message; 
	this.infoImage = new Image();
	this.infoImage.src = image("information.png");
};

InfoHeaderRenderer.prototype = new CellRenderer();
InfoHeaderRenderer.prototype.render = function(cell, value) 
{
	if (value) {
		// here we don't use cell.innerHTML = "..." in order not to break the sorting header that has been created for us (cf. option enableSort: true)
		var link = document.createElement("a");
		link.href = "javascript:alert('" + this.message + "');";
		link.appendChild(this.infoImage);
		cell.appendChild(document.createTextNode("\u00a0\u00a0"));
		cell.appendChild(link);
	}
};

//this function will initialize our editable grid
EditableGrid.prototype.initializeGrid = function() 
{
	with (this) {
		// register the function that will handle model changes
		modelChanged = function(rowIndex, columnIndex, oldValue, newValue, row) { 
			//displayMessage("Value for '" + this.getColumnName(columnIndex) + "' in row " + this.getRowId(rowIndex) + " has changed from '" + oldValue + "' to '" + newValue + "'");
			if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country

			var rowid = this.getRowId(rowIndex)
			var columnname = this.getColumnName(columnIndex);
			var total = this.getValueAt(rowIndex, this.getColumnIndex("int")) * this.getValueAt(rowIndex, this.getColumnIndex("qt"));
			if((columnname=="int") || (columnname=="qt"))
				this.setValueAt(rowIndex, this.getColumnIndex("total"), this.getValueAt(rowIndex, this.getColumnIndex("int")) * this.getValueAt(rowIndex, this.getColumnIndex("qt")));
			$.ajax({
				type: "POST",
				url: "app/sys/api/ot/devis/save_details_devis.php",
				data: {
					iddevis: id_devis,
					ligne: rowid,
					champ: columnname,
					total: total,
					val: newValue
				},
				success : function(response){
					console.log(response);
				}
			});

		};


		/*rowSelected = function(oldRowIndex, newRowIndex) {

			if (oldRowIndex < 0) displayMessage("Selected row '" + this.getRowId(newRowIndex) + "'");
			else displayMessage("Selected row has changed from '" + this.getRowId(oldRowIndex) + "' to '" + this.getRowId(newRowIndex) + "'");

		};*/

		rowRemoved = function(oldRowIndex, rowId) {
			displayMessage("Removed row '" + oldRowIndex + "' - ID = " + rowId);
		};

		// render for the action column

		// render the grid (parameters will be ignored if we have attached to an existing HTML table)
		renderGrid("tablecontent", "testgrid", "tableid");



		// bind page size selector
 	}
};
EditableGrid.prototype.onloadJSON = function(url) 
{
	// register the function that will be called when the XML has been fully loaded
	this.tableLoaded = function() { 
		displayMessage("Grid loaded from JSON: " + this.getRowCount() + " row(s)"); 
		this.initializeGrid();
	};

	// load JSON URL
	this.loadJSON(url);
};

EditableGrid.prototype.onloadHTML = function(tableId) 
{
	// metadata are built in Javascript: we give for each column a name and a type
	this.load({ metadata: [
	                       { name: "name", datatype: "string", editable: true },
	                       { name: "firstname", datatype: "string", editable: true },
	                       { name: "age", datatype: "integer", editable: true },
	                       { name: "height", datatype: "double(m,2)", editable: true, bar: false },
	                       { name: "continent", datatype: "string", editable: true, values: {"eu": "Europa", "am": "America", "af": "Africa" } },
	                       { name: "country", datatype: "string", editable: true },
	                       { name: "email", datatype: "email", editable: true },
	                       { name: "freelance", datatype: "boolean", editable: true },
	                       { name: "action", datatype: "html", editable: false }
	                       ]});

	// we attach our grid to an existing table
	this.attachToHTMLTable(_$(tableId));
	displayMessage("Grid attached to HTML table: " + this.getRowCount() + " row(s)"); 

	this.initializeGrid();
};

EditableGrid.prototype.duplicate = function(rowIndex) 
{
	// copy values from given row
	var values = this.getRowValues(rowIndex);
	values['name'] = values['name'] + ' (copy)';

	// get id for new row (max id + 1)
	var newRowId = 0;
	for (var r = 0; r < this.getRowCount(); r++) newRowId = Math.max(newRowId, parseInt(this.getRowId(r)) + 1);

	// add new row
	this.insertAfter(rowIndex, newRowId, values); 
};

