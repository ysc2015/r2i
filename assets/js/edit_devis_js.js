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

var editableGrid_tranche = new EditableGrid("tranche", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});

var editableGrid_chambre = new EditableGrid("chambre", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	maxBars: 10
});
var editableGrid_tdgc = new EditableGrid("travauxdiversgc", {
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


		modelChanged = function(rowIndex, columnIndex, oldValue, newValue, row) {

			if(this.name=="TravauxRaccordementOptiqueMesure"){


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
						tablename :"TravauxRaccordementOptiqueMesure",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="travauxReseauEntere"){


				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("TFO_0"));

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

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("EFO_0"));

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

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("ITF_0"));
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
			}else if(this.name=="tranche"){
				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("EGC_0"));

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
						tablename :"tranche",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="chambre"){

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("CGC_0"));

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
						tablename :"chambre",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}else if(this.name=="travauxdiversgc"){

				var rowid = this.getRowId(rowIndex)
				var columnname = this.getColumnName(columnIndex);
				var titrecolumn = this.getValueAt(rowIndex, this.getColumnIndex("TGC_0"));

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
						tablename :"travauxdiversgc",
						titrecolumn :titrecolumn,
						val: newValue
					},
					success : function(response){
						//console.log(response);
					}
				});
			}
			var name_div_to_change = '';
			switch (this.name){
				case 'TravauxRaccordementOptiqueMesure' : name_div_to_change ='div_RFO' ;break;
				case 'travauxReseauEntere' : name_div_to_change ='div_TFO' ;break;
				case 'etude' : name_div_to_change ='div_EFO' ;break;
				case 'travauxsitetechnique' : name_div_to_change = 'div_ITF';break;
				case 'tranche' : name_div_to_change ='div_EGC' ;break;
				case 'chambre' : name_div_to_change = 'div_CGC';break;
				case 'travauxdiversgc' : name_div_to_change = 'div_TGC';break;
			}
			var total_calume_lors_traitement = 0;
			for (var i = 0; i < this.data.length-1; i++) {
				total_calume_lors_traitement +=this.getValueAt(i, this.getColumnIndex("total"));
			}
			this.setValueAt((this.data.length-1), this.getColumnIndex("total"), total_calume_lors_traitement);

			$('#'+name_div_to_change).html(total_calume_lors_traitement);

		};


		renderGrid(id, param2, param3);
 	}
};
EditableGrid.prototype.onloadJSON = function(url,id, param2, param3,callback)
{
	// register the function that will be called when the XML has been fully loaded
	this.tableLoaded = function() { 
		//displayMessage("Grid loaded from JSON: " + this.getRowCount() + " row(s)");
		this.initializeGrid(id, param2, param3);
	};
	this.loadJSON(url,callback);
};


