<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>

        .links line {
            stroke: #999;
            stroke-opacity: 0.6;
        }

        .nodes rect {
            stroke: #fff;
            stroke-width: 1.5px;
        }

        .txt {
            color: black;
            font-size: 12px;
        }

        svg {
            border: solid 1px red;
        }

        body {
            text-align: center;
        }

    </style>

    <script src="../assets/plugins/jQuery-2.1.4.min.js" type="application/javascript"></script>

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js" type="application/javascript"></script>

    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

<svg width="960" height="600"></svg>
<script src="d3.min.js"></script>

<?php include_once '../modal.html'; ?>

<script>


    var svg = d3.select("svg"),
        width = +svg.attr("width"),
        height = +svg.attr("height");

    var color = d3.scaleOrdinal(d3.schemeCategory20);

    var simulation = d3.forceSimulation()
        .force("link", d3.forceLink().id(function (d) {
            return d.id;
        }))
        .force("charge", d3.forceManyBody())
        .force("center", d3.forceCenter(width / 2, height / 2));

    d3.json("service.php", function (error, graph) {
        if (error) throw error;

        var link = svg.append("g")
            .attr("class", "links")
            .selectAll("line")
            .data(graph.links)
            .enter().append("line")
            .attr("stroke-width", function (d) {
                return 3;
            });

        var node = svg.append("g")
            .attr("class", "nodes")
            .selectAll("rect")
            .data(graph.nodes)
            .enter().append("rect")
            .attr("width", function (d) {
                return ("Ref Chambre : " + d.ref).length * 6.5;
            })
            .attr("height", 40)
            .attr("fill", function (d) {
                return color(d.group);
            })
            .attr("x", function (d) { return d.id + 120; })
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended));

        var text = svg.append("g")
            .attr('class', 'txt')
            .selectAll('text')
            .data(graph.nodes)
            .enter().append("text")
            .text(function (d) {
                return "Ref Chambre : " + d.ref;
            })
            //.attr("fill", function(d) { return color(d.group); })
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended));

        var text2 = svg.append("g")
            .attr('class', 'txt')
            .selectAll('text')
            .data(graph.nodes)
            .enter().append("text")
            .text(function (d) {
                return "Type Chambre" + d.type;
            })
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended));


        node.append("title")
            .text(function (d) {
                return d.id;
            });

        simulation
            .nodes(graph.nodes)
            .on("tick", ticked);

        simulation.force("link")
            .links(graph.links);

        var lastSelected = null;

        function ticked() {
            link
                .attr("x1", function (d) {
                    return d.source.x;
                })
                .attr("y1", function (d) {
                    return d.source.y;
                })
                .attr("x2", function (d) {
                    return d.target.x;
                })
                .attr("y2", function (d) {
                    return d.target.y;
                })
                .on('click', function (d) {
                    if (lastSelected != null) {
                        d3.select(lastSelected).style('stroke', '#999');
                    }
                    d3.select(this).style('stroke', 'rgb(255,0,0)');
                    click();
                    lastSelected = this;
                });
            node
                .attr("x", function (d) {
                    return d.x;
                })
                .attr("y", function (d) {
                    return d.y;
                });

            text
                .attr('x', function (d) {
                    return d.x + 5;
                })
                .attr('y', function (d) {
                    return d.y + 14;
                });

            text2
                .attr('x', function (d) {
                    return d.x + 5;
                })
                .attr('y', function (d) {
                    return d.y + 27;
                });

        }
    });

    function dragstarted(d) {
        if (!d3.event.active) simulation.alphaTarget(0.3).restart();
        d.fx = d.x;
        d.fy = d.y;
    }

    function dragged(d) {
        d.fx = d3.event.x;
        d.fy = d3.event.y;
    }

    function dragended(d) {
        //if (!d3.event.active) simulation.alphaTarget(0);
        //d.fx = null;
        //d.fy = null;
    }

</script>

</body>


</html>
