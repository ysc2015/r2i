var myStyles = ['red'];

d3.selectAll('.item')
  .data(myStyles)
  .style('background', function (d){
    console.log(d);
    return d;
  });

  d3.select("#main")
    .selectAll("p")
    .data([4, 8, 15, 16, 23, 42])
    .enter().append("p")
      .text(function(d) { return "I’m number " + d + "!"; });

d3.select("#main").transition()
  .style("background-color", "black");
var scale = 1;

d3.selectAll("circle")
  .transition()
  .duration(750)
  .delay(function(d, i) {
    console.log(d,i);
    return i * 10;
  })
  .attr("r", function(d) {
    if(d === undefined) d = 0.5;
    console.log('D',d)
    return Math.sqrt(d * scale);
  });
