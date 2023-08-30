$(function () {
    const block = $('#time-track-block');
    const time = block.attr('data-time');
    const startDate = new Date(time);
    block.find('span').text(getDates(startDate));

    setInterval(() => {
        block.find('span').text(getDates(startDate));
    }, 1000);
});

const getDates = (startDate) => {
    let date = new Date();
    let difference = Math.round((date.getTime() - startDate.getTime()) / 1000);

    let minute = +Math.floor(difference / 60);
    let seconds = +(difference - minute * 60)

    minute = minute >= 10 ? minute : `0${minute}`;
    seconds = seconds >= 10 ? seconds : `0${seconds}`;

    return `${minute}:${seconds}`;
}
