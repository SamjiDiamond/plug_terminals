// Side Bar
$('.sideBarBtn, .closeBtn').click(function(){
  console.log('Hello');
  $('.sideBarNavContainer').toggleClass('active');
  $('.mainBodyContainer').toggleClass('active');
  $('.mainBarNavDiv').toggleClass('active');
});

// Notifications Panel
$('.mainBarNavContainer .notifications svg.notification, .mainBarNavContainer .closeNotifications').on('click', function(){
  console.log('A');
  $('.mainBarNavContainer .notifications .notificationsList').toggleClass('active');
});


// Date & Time Picker (Reference - https://www.daterangepicker.com)
$(function() {
    let start = moment().subtract(29, 'days');
    let end = moment();

    function cb(start, end) {
        // $('.reportRangePicker span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $('.reportRangePicker span').html(start.format('MMM D') + ' - ' + end.format('MMM D'));
    }
    $('.reportRangePicker').daterangepicker({
        startDate: start,
        endDate: end
        // ranges: {
        // 'Today': [moment(), moment()],
        // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        // 'This Month': [moment().startOf('month'), moment().endOf('month')],
        // 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        // }
    }, cb);

    cb(start, end);
});


// Right Bar
    $('.mainBodyRightContainerTrigger, .mainBodyRightCloseBtn, .mainBodyRightDivCloseContainer').click(function(){
      $('.mainBodyRightContainer').toggleClass('active');
      $('.mainBodyRightDiv').addClass('animate__fadeInDown');
  });

  $('.panelRightBarSwitch').click(function(){
      let dataTabValue = $(this).attr('data-right-tab');
      $('.rightTabContent[data-right-tabcontent]').removeClass('active');
      $('.rightTabContent[data-right-tabcontent='+dataTabValue+']').addClass('active');
  });

  $('.panelTabSwitch').click(function(){
      let dataTabValue = $(this).attr('data-tab');
      $('.panelTabSwitch').removeClass('active');
      $(this).addClass('active');

      $('.materialCard[data-tab-content]').removeClass('active');
      $('.materialCard[data-tab-content='+dataTabValue+']').addClass('active');
  });

// Modal
$('.opencloseModal[data-trigger-id]').on('click', function() {
    let modalDataTriggerId = $(this).attr('data-trigger-id');
    $('.materialModalContainer[data-trigger-content="'+modalDataTriggerId+'"]').toggleClass('active');
})

$('.closeModal').on('click', function() {
    $(this).closest('.materialModalContainer[data-trigger-content]').toggleClass('active');
})


let barChartFunc = (series, months, selector) => {
    let barChartOptions = {
      series: series,
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      colors: ['#96f4be', '#fb9157', '#ffe681'],
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: months,
      },
      yaxis: {
        title: {
          text: 'NGN (millions)'
        },
        labels: {
          formatter: function(value, index) {
            return (value / 1000000) + 'M'
          }
        } 
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "&#8358; " + (val/1000000) + " millions"
          }
        }
      }
    };
    let barChart = new ApexCharts(document.querySelector("."+selector), barChartOptions);
    barChart.render();
}


let pieChartFunc = (series, labels, selector) => {
  let pieChartOptions = {
    series: series,
    chart: {
      type: 'donut',
    },
    labels: labels,
    legend: false,
    colors: ['#f7803f', '#aeaeae'],
    responsive: [{
      breakpoint: 200,
      options: {
        chart: {
          width: 10
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    stroke: {
      curve: 'smooth',
      width: 1.25
    }
  };

  let pieChart = new ApexCharts(document.querySelector("." + selector), pieChartOptions);
  pieChart.render();
}


let lineChartFunc = (series, categories, selector) => {
  let lineChartOptions = {
    series: series,
    chart: {
      height: 350,
      type: 'line',
      dropShadow: {
        enabled: false,
        color: '#000',
        top: 18,
        left: 7,
        blur: 10,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    colors: ['#31bf6e', '#df7d2d', '#545454'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: 'smooth',
      width: 1.25
    },
    title: {
      text: '',
      align: 'left'
    },
    grid: {
      borderColor: '#e7e7e7',
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    markers: {
      size: 1
    },
    xaxis: {
      categories: categories,
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: ''
      }
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: -5
    }
  };
  let lineChart = new ApexCharts(document.querySelector("." + selector), lineChartOptions);
  lineChart.render();
}

let radialBarChartFunc = (series, labels, selector, colorCode) => {
  let colorArray = ['#df7d2d', '#31bf6e', '#f5c400']

  let radialBarChartOptions = {
    series: series,
    chart: {
      height: 300,
      type: 'radialBar',
    },
    plotOptions: {
      radialBar: {
        hollow: {
          size: '85%',
        }
      },
    },
    labels: labels,
    colors: [colorArray[colorCode]],
  };
  let radialBarChart = new ApexCharts(document.querySelector("." + selector), radialBarChartOptions);
  radialBarChart.render();
}