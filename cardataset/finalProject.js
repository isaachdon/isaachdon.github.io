var CHART_SIZE = 425;

    // create data array
    var dataset = d3.csv('Car_sales.csv', function(data) {

        // fixes an issue with finding the max
        data.forEach(function(d) {
            d.Price = parseInt(d.Price*1000);
            d.Sales = parseInt(d.Sales*1000);
            d.Horsepower = parseInt(d.Horsepower);
            d.FuelEfficiency = parseInt(d.Fuel_efficiency);
        });
        
        var customSelect = d3.select("#selection").node().value;

        first(data, customSelect);
        
        d3.select("select")
            .on("change",function(d){
                customSelect = d3.select("#selection").node().value;
                d3.select("#main").html("");
                d3.select("#parallel").html("");
                d3.select("#legend").html("");
                first(data, customSelect);
            })
        
        
        function first(data, customSelect) {
        
        var svg = d3.select("svg");

        // create scales for X, Y, Z, and W
        var xScale = d3.scaleLinear()
            .domain([0, d3.max(data, function(d) { return +d[customSelect] })]).range([0, CHART_SIZE]); //replace here too
        var yScale = d3.scaleLinear()
            .domain([0, d3.max(data, function(d) { return d.Sales })]).range([CHART_SIZE, 0]);
            
        var myColor = d3.scaleSequential().domain([0, d3.max(data, function(d) { return +d[customSelect] })])
            .interpolator(d3.interpolateCool);
        
        var cars = [ "Acura", "Audi", "BMW", "Buick", "Cadillac", "Chevrolet", "Chrysler", "Dodge",  "Ford", "Honda",  "Hyundai", "Infiniti", "Jaguar", "Jeep", "Lexus", "Lincoln", "Mitsubishi", "Mercury", "Mercedes-B", "Nissan", "Oldsmobile", "Plymouth", "Pontiac", "Porsche", "Saab", "Saturn", "Subaru", "Toyota", "Volkswagen", "Volvo"];


        var margin = {top: 50, right: 10, bottom: 10, left: 0},
            width = 150 - margin.left - margin.right,
            height = 550 - margin.top - margin.bottom;
            
        //d3 function to move selected points to front
        d3.selection.prototype.moveToFront = function() {  
            return this.each(function(){
            this.parentNode.appendChild(this);
            });
        };

        // append the svg object to the body of the page
        var legend = d3.select('#legend')
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)

            legend.selectAll('circle')
              .data(cars)
              .enter()
              .append('circle')
                .attr('cx',10)
                .attr('cy', function(d,i) {return (i*17) + 25})
                .attr('r', 4)
                .style('fill', '#319e9e')
                .attr('id', function(d) { return 'circle_' + d; } )

        legend.selectAll('text')
              .data(cars)
              .enter()
              .append('text')
                .attr('x', 27)
                .attr('y', function(d,i) {return (i*17) + 27})
                .style('fill', '#319e9e')
                .text(function(d) {return d})
                .attr('id', function(d) { return 'label_' + d; } )
                .attr('text-anchor', 'left')
                .style('alignment-baseline', 'middle')

        legend.selectAll('text')
              .on('mouseover', function(d)
              {
                d3.select("#circle_" + d)
                    .style('fill', 'red')
                    .attr('r', '5px')

                d3.select('#label_' + d)
                    .style('fill', 'red')
                    .style('font-weight', 'bold')

                d3.selectAll('.left_' + d)
                  .style('fill', 'red')
                  .attr('r', '8px')

                 d3.selectAll(".right_" + d)
                    .style('stroke', 'red')
                    .style('stroke-width', '3px')
                    .style ('opacity', 1)
                    .moveToFront();
              })
                    
            
              .on('mouseout', function(d) {
                d3.select("#circle_" + d)
                    .style('fill', '#319e9e')
                    .attr('r', '4px')

                d3.select('#label_' + d)
                    .style('fill', '#319e9e')
                    .style('font-weight', 'normal')


                d3.selectAll(".left_" + d)
                    .style('fill', function(d){return myColor(+d[customSelect]) })
                    .attr('r', '5px');

                d3.selectAll(".right_" + d)
                    .style('stroke', function(d){return myColor(+d[customSelect]) })
                    .style('opacity', 0.5)
                    .style('stroke-width', 2)
                  });
        
        
        // scatterplot on left
        // ====================
        var gLeft = svg.append('g')
            .attr('transform', 'translate(120,25)')
        gLeft.selectAll('circle')
            .data(data)
            .enter().append('circle')
            .attr('r', '5px')
            .attr('cx', function(d) { return xScale(+d[customSelect])})  //replace with variable
            .attr('cy', function(d) { return yScale(d.Sales)})
            .attr('id', function(d) { return 'left_' + d.ID; } )
            .attr('class', function(d) {return 'left_' + d.Manufacturer})
            .attr('class', function(d) {return 'left_' + d.Manufacturer})
            .style('fill', function(d){return myColor(+d[customSelect]) });



        // tooltip
        var div = d3.select("body").append("div")	
            .attr("class", "tooltip")				
            .style("opacity", 0);

        // Add interaction events
        // ======================
        gLeft.selectAll('circle')
            .on('mouseover', function(d) 
            {
                d3.select("#left_" + d.ID)
                    .style('fill', 'red')
                    .attr('r', '8px')

                div.transition()		
                    .duration(200)		
                    .style("opacity", .9);		
                div.html(d.Manufacturer + " " + d.Model + "<br>Sales: " + d.Sales + "<br>" + customSelect + ": " + +d[customSelect])	
                    .style("left", (d3.event.pageX + 10) + "px")		
                    .style("top", (d3.event.pageY) + "px");	

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////highlight parallel chart at same time
                d3.select("#right_" + d.ID)
                    .style('fill', 'red')
                    .attr('r', '8px')
            
                d3.select("#circle_" + d.Manufacturer)
                    .style('fill', 'red')
                    .attr('r', '6px')

                d3.select('#label_' + d.Manufacturer)
                    .style('fill', 'red')
                    .style('font-weight', 'bold')

                // move brushed circle so that it's on top
                this.parentNode.appendChild(this);

            })

            .on('mouseout', function(d) {
                d3.select("#left_" + d.ID)
                    .style('fill', function(d){return myColor(+d[customSelect]) })
                    .attr('r', '5px');

                d3.select("#right_" + d.ID)
                    .style('fill', null);
            
                d3.select('#label_' + d.Manufacturer)
                    .style('fill', '#319e9e')
                    .style('font-weight', 'normal');
            
                d3.select("#circle_" + d.Manufacturer)
                    .style('fill', '#319e9e')
                    .attr('r', '4px')

                div.transition()		
                    .duration(200)		
                    .style("opacity", 0);	
            })

        // create bottom/left axes
        gLeft.append('g')
            .attr('class', 'axis')
            .attr('transform', 'translate(0,' + CHART_SIZE + ')')
            .call(d3.axisBottom(xScale))

        gLeft.append('g')
            .attr('class', 'axis')
            .call(d3.axisLeft(yScale))

        // add labels to the axes
        gLeft.append('text')
            .attr('transform', 'translate(' + (CHART_SIZE/2) + ',' + (CHART_SIZE+40) + ')')
            .attr('text-anchor', 'middle')
            .style('font-weight', 'bold')
            .html(customSelect);

        gLeft.append('text')
            .attr('transform', 'translate(' + (-80) + ',' + (CHART_SIZE/2) + ')')
            .attr('text-anchor', 'middle')
            .style('font-weight', 'bold')
            .html('Sales');
        
        
        
        ////////////////////////////////////////////////////////parallel coordinates chart
        // set the dimensions and margins of the graph
        var margin = {top: 30, right: 0, bottom: 10, left: 0},
          width = 550 - margin.left - margin.right,
          height = 550 - margin.top - margin.bottom;

        // append the svg object to the body of the page
        var svg = d3.select("#parallel")
        .append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
        .append("g")
          .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");

          // Extract the list of dimensions we want to keep in the plot
          dimensions = ["Horsepower", customSelect, "Sales"];

          // For each dimension, I build a linear scale. I store all in a y object
          var y = {}
          for (i in dimensions) {
            name = dimensions[i]
            y[name] = d3.scaleLinear()
              .domain( d3.extent(data, function(d) { return +d[name]; }) )
              .range([height, 0])
          }

          // Build the X scale -> it find the best position for each Y axis
          x = d3.scalePoint()
            .range([0, width])
            .padding(1)
            .domain(dimensions);

          // The path function take a row of the csv as input, and return x and y coordinates of the line to draw for this raw.
          function path(d) {
              return d3.line()(dimensions.map(function(p) { return [x(p), y[p](d[p])]; }));
          }

          // Draw the lines
          svg
            .selectAll("myPath")
            .data(data)
            .enter().append("path")
            .attr("d",  path)
            .attr('id', function(d) { return 'right_' + d.ID; } )
            .attr('class', function(d) {return 'right_' + d.Manufacturer})
            .style("fill", "none")
            .style("stroke", function(d){return myColor(+d[customSelect]) })
            .style("opacity", 0.5)
                .on('mouseover', function(d) 
                    {
                        d3.select("#right_" + d.ID)
                            .style('stroke', 'red')
                            .style('stroke-width', '3px')
                            .style('opacity', 1)

                        div.transition()		
                            .duration(200)		
                            .style("opacity", .9);		
                        div.html(d.Manufacturer + " " + d.Model + "<br>Sales: " + d.Sales + "<br>Price: $" + d.Price)	
                            .style("left", (d3.event.pageX + 10) + "px")		
                            .style("top", (d3.event.pageY) + "px");	

                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////highlight scatter plot at same time
                        d3.select("#left_" + d.ID)
                            .style('fill', 'red')
                            .attr('r', '8px');
              
                        d3.select("#circle_" + d.Manufacturer)
                            .style('fill', 'red')
                            .attr('r', '6px')

                        d3.select('#label_' + d.Manufacturer)
                            .style('fill', 'red')
                            .style('font-weight', 'bold')

                        // move brushed circle so that it's on top
                        this.parentNode.appendChild(this);

                    })

                    .on('mouseout', function(d) {
                        d3.select("#right_" + d.ID)
                            .style('stroke', function(d){return myColor(+d[customSelect]) })
                            .attr('r', '6px')
                            .style('fill', null)
                            .style('stroke-width', '2px')
                            .style('opacity', .5)
              
                        d3.select("#circle_" + d.Manufacturer)
                            .style('fill', '#319e9e')
                            .attr('r', '4px');

                        d3.select('#label_' + d.Manufacturer)
                            .style('fill', '#319e9e')
                            .style('font-weight', 'normal');

                        div.transition()		
                            .duration(200)		
                            .style("opacity", 0);

                        d3.select("#left_" + d.ID)
                            .style('fill', function(d){return myColor(+d[customSelect]) })
                            .attr('r', '5px');

                        div.transition()		
                            .duration(200)		
                            .style("opacity", 0);	
                    })

          // Draw the axis:
          svg.selectAll("myAxis")
            // For each dimension of the dataset I add a 'g' element:
            .data(dimensions).enter()
            .append("g")
            // I translate this element to its right position on the x axis
            .attr("transform", function(d) { return "translate(" + x(d) + ")"; })
            // And I build the axis with the call function
            .each(function(d) { d3.select(this).call(d3.axisLeft().scale(y[d])); })
            // Add axis title
            .append("text")
              .style("text-anchor", "middle")
              .attr("y", -9)
              .text(function(d) { return d; })
              .style("fill", "black")

                }});