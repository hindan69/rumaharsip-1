(function (factory) {
  typeof define === 'function' && define.amd ? define(factory) : factory();
})(() => {
  'use strict';

  const { merge } = window._;
  
  const echartSetOption = (chart, userOptions, getDefaultOptions, responsiveOptions) => {
    const { breakpoints, resize } = window.phoenix.utils;
    const handleResize = options => {
      Object.keys(options).forEach(item => {
        if (window.innerWidth > breakpoints[item]) {
          chart.setOption(options[item]);
        }
      });
    };

    const themeController = document.body;
    chart.setOption(merge(getDefaultOptions(), userOptions));

    const navbarVerticalToggle = document.querySelector('.navbar-vertical-toggle');
    if (navbarVerticalToggle) {
      navbarVerticalToggle.addEventListener('navbar.vertical.toggle', () => {
        chart.resize();
        if (responsiveOptions) {
          handleResize(responsiveOptions);
        }
      });
    }

    resize(() => {
      chart.resize();
      if (responsiveOptions) {
        handleResize(responsiveOptions);
      }
    });
    if (responsiveOptions) {
      handleResize(responsiveOptions);
    }

    themeController.addEventListener('clickControl', ({ detail: { control } }) => {
      if (control === 'phoenixTheme') {
        chart.setOption(merge(getDefaultOptions(), userOptions));
      }
      if (responsiveOptions) {
        handleResize(responsiveOptions);
      }
    });
  };

  // Inisialisasi fungsi untuk bar chart
  const barNegativeChartInit = () => {
    const { getColor, getData } = window.phoenix.utils;
    const $chartEl = document.querySelector('.echart-bar-negative-chart-example');

    if ($chartEl) {
      fetch('/satker/datachart')
        .then(response => response.json())
        .then(data => {
          if (!data) throw new Error("Data not found");

          const satkerNames = data.map(satker => satker.satker); // Nama Satker
          const dataValues = data.map(satker => satker.jml_permasalahan); // Data nilai permasalahan

          const userOptions = getData($chartEl, 'echarts');
          const chart = window.echarts.init($chartEl);

          const getDefaultOptions = () => ({
            tooltip: {
              trigger: 'axis',
              axisPointer: { type: 'shadow' },
              padding: [7, 10],
              backgroundColor: getColor('body-highlight-bg'),
              borderColor: getColor('border-color'),
              textStyle: { color: getColor('light-text-emphasis') },
              borderWidth: 1,
              transitionDuration: 0,
              formatter: params => tooltipFormatter(params)
            },
            grid: { top: 5, bottom: 5, left: 5, right: 5 },
            xAxis: {
              type: 'value',
              position: 'top',
              splitLine: { lineStyle: { type: 'dashed', color: getColor('secondary-bg') } }
            },
            yAxis: {
              type: 'category',
              axisLine: { show: false },
              axisLabel: { show: false },
              axisTick: { show: false },
              splitLine: { show: false },
              data: satkerNames // Nama Satker dari database
            },
            series: [
              {
                name: 'Cost',
                type: 'bar',
                stack: 'total',
                label: {
                  show: true,
                  formatter: '{b}',
                  color: '#fff'
                },
                itemStyle: { color: getColor('primary') },
                data: dataValues // Data nilai dari database
              }
            ]
          });

          echartSetOption(chart, userOptions, getDefaultOptions);
        })
        .catch(error => console.error('Error fetching data:', error));
    }
  };

  const { docReady } = window.phoenix.utils;

  // Inisialisasi semua fungsi chart saat dokumen siap
  docReady(barNegativeChartInit);
  docReady(horizontalBarChartInit);
  docReady(seriesBarChartInit);
  docReady(stackedBarChartInit);
  docReady(stackedHorizontalBarChartInit);

});
//# sourceMappingURL=echarts-example.js.map
