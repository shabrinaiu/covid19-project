$(function () {
  let draw = Chart.controllers.line.prototype.draw;
  Chart.controllers.line = Chart.controllers.line.extend({
      draw: function() {
          draw.apply(this, arguments);
          let ctx = this.chart.chart.ctx;
          let _stroke = ctx.stroke;
          ctx.stroke = function() {
              ctx.save();
              ctx.shadowColor = "rgba(0,0,0,0.1)";
              ctx.shadowBlur = 10;
              ctx.shadowOffsetX = 0;
              ctx.shadowOffsetY = 2;
              _stroke.apply(this, arguments)
              ctx.restore();
          }
      }
  });
  
  Chart.defaults.LineWithLine = Chart.defaults.line;
  Chart.controllers.LineWithLine = Chart.controllers.line.extend({
     draw: function(ease) {
        Chart.controllers.line.prototype.draw.call(this, ease);
  
        if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
           var activePoint = this.chart.tooltip._active[0],
              ctx = this.chart.ctx,
              x = activePoint.tooltipPosition().x,
              topY = this.chart.scales['y-axis-0'].top,
              bottomY = this.chart.scales['y-axis-0'].bottom;
  
           // draw line
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(x, topY);
            ctx.lineTo(x, bottomY);
            ctx.lineWidth = 1;
            ctx.strokeStyle = 'transparent';
            ctx.stroke();
            ctx.restore();
        }
     }
  });
  
  var chart = new Chart(ctx, {
     type: 'LineWithLine',
     data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Statistics',
            data: [3, 1, 2, 5, 4, 7, 6],
            borderColor: "#80b6f4",
            pointBorderColor: "#80b6f4",
            pointBackgroundColor: "#80b6f4",
            pointHoverBackgroundColor: "#80b6f4",
            pointHoverBorderColor: "#80b6f4",
            pointBorderWidth: 10,
            pointHoverRadius: 10,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
        }]
     },
     options: {
        legend: {
          position: "bottom"
        },
        responsive: false,
        tooltips: {
           intersect: false
        },
        scales: {
          yAxes: [{
              ticks: {
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "bold",
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  padding: 20
              },
              gridLines: {
                  drawTicks: false,
                  display: false
              }
            }],
          xAxes: [{
              gridLines: {
                  zeroLineColor: "transparent"},
              ticks: {
                  padding: 20,
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "bold"
              }
          }]
      }
     }
  });
});