const RECT_WIDTH = 200;
const RECT_HEIGHT = 60;
const RECT_X = 10;

const TEXT_X = 15;
const TEXT_X_OFFSET = 80;

const TEXT_RECT_OFFSET = 20;

const RECT_Y_START = 10;

const RECT_FILL_STYLE = 'rgb(255,255,255)';
const RECT_STROKE_WIDTH = 3;
const RECT_STROKE = 'rgb(0,0,0)';

const RECT_OFFSET = 80;
var mainSVG = null;

function getTypeChambreLib(id) {
    for(var i = 0 ; i < type_chambre_options.length ; i++) {
        if(type_chambre_options[i].id_type_chambre == id) {
            return type_chambre_options[i].lib_type_chambre;
        }
    }
    return id;
}

function addElementToMainSvg(element) {
    if (mainSVG == null) {
        mainSVG = document.getElementById('mainSVG');
    }
    mainSVG.appendChild(element);
}

function getRect(x, y) {
    var rect = document.createElementNS("http://www.w3.org/2000/svg", 'rect');
    rect.setAttribute('x', x);
    rect.setAttribute('y', y);
    rect.setAttribute('width', RECT_WIDTH);
    rect.setAttribute('height', RECT_HEIGHT);
    rect.setAttribute('fill', RECT_FILL_STYLE);
    rect.setAttribute('stroke-width', RECT_STROKE_WIDTH);
    rect.setAttribute('stroke', RECT_STROKE);
    return rect;
}

function getText(x, y, content) {
    var text = document.createElementNS("http://www.w3.org/2000/svg", 'text');
    text.setAttribute('x', x);
    text.setAttribute('y', y);
    text.setAttribute('fill', 'red');
    text.textContent = content;
    return text;
}

function createLink(y, linkID) {
    var line = document.createElementNS("http://www.w3.org/2000/svg", 'line');
    line.setAttribute('x1', 10 + (RECT_WIDTH / 2));
    line.setAttribute('y1', y - RECT_OFFSET + RECT_HEIGHT);

    line.setAttribute('x2', 10 + (RECT_WIDTH / 2));
    line.setAttribute('y2', y);
    line.setAttribute('stroke', 'red');
    line.setAttribute('stroke-width', 4);
    line.setAttribute('data-id', linkID);
    line.setAttribute('onclick', 'tronconClick(this)');
    addElementToMainSvg(line);
}

function createRect(y, refText, typeText) {
    var rect = getRect(RECT_X, y);

    var calculated_y = y + TEXT_RECT_OFFSET;
    var calculated_x = TEXT_X;

    var ref = getText(calculated_x, calculated_y, 'Référence');

    calculated_x += TEXT_X_OFFSET;
    var refValue = getText(calculated_x, calculated_y, refText);

    calculated_x = TEXT_X;
    calculated_y += TEXT_RECT_OFFSET;

    var typeLib = getText(calculated_x, calculated_y, 'Type');

    calculated_x += TEXT_X_OFFSET;

    var typeValue = getText(calculated_x, calculated_y, getTypeChambreLib(typeText));

    addElementToMainSvg(rect);
    addElementToMainSvg(ref);
    addElementToMainSvg(refValue);
    addElementToMainSvg(typeValue);
    addElementToMainSvg(typeLib);
}

var x = 10;
var y = 10;

var first = true;
function drawGraph(graph, linkID) {
    console.log(graph);
    if (graph == null) {
        return;
    }
    if (!first) {
        createLink(y, linkID);
    }
    createRect(y, graph.ref, graph.type);
    y += RECT_OFFSET;
    first = false;
    var linkID = (graph.link != null ? graph.link[0] : null);
    drawGraph(graph.next[0], linkID);
}