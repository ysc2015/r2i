//create our editable grid
var editableGrid = new EditableGrid("TravauxRaccordementOptiqueMesure", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});


var editableGrid_travaux_reseau_entere = new EditableGrid("travauxReseauEntere", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});
var editableGrid_etude = new EditableGrid("etude", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});
var editableGrid_tst = new EditableGrid("travauxsitetechnique", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});

//helper function to display a message
function displayMessage(text, style) { 
	_$("message").innerHTML = "<p class='" + (style || "ok") + "'>" + text + "</p>"; 
}

EditableGrid.prototype.initializeGrid = function(id, param2, param3)
{
	with (this) {
		console.log(id);

		modelChanged = function(rowIndex, columnIndex, oldValue, newValue, row) {
			if(this.name=="TravauxRaccordementOptiqueMesure"){
				if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				console.log("tata "+rowid);
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
						tablename :"TravauxRaccordementOptiqueMesure",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="travauxReseauEntere"){
				if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("TFO_0"));
				console.log("tata "+rowid);
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
						tablename :"travauxReseauEntere",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="etude"){
				if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("EFO_0"));
				console.log("tata "+rowid);
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
						tablename :"etude",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="travauxsitetechnique"){
				if (this.getColumnName(columnIndex) == "continent") this.setValueAt(rowIndex, this.getColumnIndex("country"), ""); // if we changed the continent, reset the country

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("ITF_0"));
				console.log("tata "+rowid);
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
						tablename :"travauxsitetechnique",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}


		};
		console.log("passed modelChanged : "+id);

		renderGrid(id, param2, param3);
 	}
};
EditableGrid.prototype.onloadJSON = function(url,id, param2, param3)
{
	// register the function that will be called when the XML has been fully loaded
	this.tableLoaded = function() { 
		//displayMessage("Grid loaded from JSON: " + this.getRowCount() + " row(s)");
		this.initializeGrid(id, param2, param3);
	};
	this.loadJSON(url);
};


