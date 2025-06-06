import { echartSetOption } from './echarts-utils';
/* -------------------------------------------------------------------------- */
/*                     Echart Bar Member info                                 */
/* -------------------------------------------------------------------------- */

const newUsersChartsInit = () => {
  const { getColor, getData, getPastDates, rgbaColor } = window.phoenix.utils;
  const $echartnewUsersCharts = document.querySelector('.echarts-new-users');
  const tooltipFormatter = params => {
    const currentDate = window.dayjs(params[0].axisValue);
    const prevDate = window.dayjs(params[0].axisValue).subtract(1, 'month');

    const result = params.map((param, index) => ({
      value: param.value,
      date: index > 0 ? prevDate : currentDate,
      color: param.color
    }));

    let tooltipItem = ``;
    result.forEach((el, index) => {
      tooltipItem += `<h6 class="fs-9 text-body-tertiary ${
        index > 0 && 'mb-0'
      }"><span class="fas fa-circle me-2" style="color:${el.color}"></span>
      ${el.date.format('MMM DD')} : ${el.value}
    </h6>`;
    });
    return `<div class='ms-1'>
              ${tooltipItem}
            </div>`;
  };

  if ($echartnewUsersCharts) {
    const userOptions = getData($echartnewUsersCharts, 'echarts');
    const chart = window.echarts.init($echartnewUsersCharts);
    const dates = getPastDates(12);
    const getDefaultOptions = () => ({
      tooltip: {
        trigger: 'axis',
        padding: 10,
        backgroundColor: getColor('body-highlight-bg'),
        borderColor: getColor('border-color'),
        textStyle: { color: getColor('light-text-emphasis') },
        borderWidth: 1,
        transitionDuration: 0,
        axisPointer: {
          type: 'none'
        },
        formatter: tooltipFormatter,
        extraCssText: 'z-index: 1000'
      },
      xAxis: [
        {
          type: 'category',

          data: dates,
          show: true,
          boundaryGap: false,
          axisLine: {
            show: false
          },
          axisTick: {
            show: false
          },
          axisLabel: {
            formatter: value => window.dayjs(value).format('DD MMM, YY'),
            showMinLabel: true,
            showMaxLabel: false,
            color: getColor('secondary-color'),
            align: 'left',
            interval: 5,
            fontFamily: 'Nunito Sans',
            fontWeight: 600,
            fontSize: 12.8
          }
        },
        {
          type: 'category',
          position: 'bottom',
          show: true,
          data: dates,
          axisLabel: {
            formatter: value => window.dayjs(value).format('DD MMM, YY'),
            interval: 130,
            showMaxLabel: true,
            showMinLabel: false,
            color: getColor('secondary-color'),
            align: 'right',
            fontFamily: 'Nunito Sans',
            fontWeight: 600,
            fontSize: 12.8
          },
          axisLine: {
            show: false
          },
          axisTick: {
            show: false
          },
          splitLine: {
            show: false
          },
          boundaryGap: false
        }
      ],
      yAxis: {
        show: false,
        type: 'value',
        boundaryGap: false
      },
      series: [
        {
          type: 'line',
          data: [220, 220, 150, 150, 150, 250, 250, 400, 400, 400, 300, 300],
          lineStyle: {
            width: 2,
            color: getColor('info')
          },
          areaStyle: {
            color: {
              type: 'linear',
              x: 0,
              y: 0,
              x2: 0,
              y2: 1,
              colorStops: [
                {
                  offset: 0,
                  color: rgbaColor(getColor('info'), 0.2)
                },
                {
                  offset: 1,
                  color: rgbaColor(getColor('info'), 0)
                }
              ]
            }
          },
          showSymbol: false,
          symbol: 'circle',
          zlevel: 1
        }
      ],
      grid: { left: 0, right: 0, top: 5, bottom: 20 }
    });
    echartSetOption(chart, userOptions, getDefaultOptions);
  }
};

export default newUsersChartsInit;
