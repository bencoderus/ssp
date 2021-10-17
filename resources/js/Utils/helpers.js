const formatDate = (date) => {
    const d = new Date(date);
    const month = `0${d.getMonth() + 1}`.slice(-2);
    const day = `0${d.getDate()}`.slice(-2);
    const year = d.getFullYear();

    return `${day}/${month}/${year}`;
};

const formatInputDate = (date) => {
    const d = new Date(date);
    const month = `0${d.getMonth() + 1}`.slice(-2);
    const day = `0${d.getDate()}`.slice(-2);
    const year = d.getFullYear();

    return `${year}-${month}-${day}`;
};

const formatMoney = (number) => {
    return number.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
}

export {formatDate, formatInputDate};
