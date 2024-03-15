
function pmt(rate, nper, pv) {
    let pvif, pmt;

    pvif = Math.pow(1 + rate, nper);
    pmt = rate / (pvif - 1) * -(pv * pvif);

    return pmt;
};

function computeSchedule(loan_amount, interest_rate, payments_per_year, years, payment) {
    let schedule = [];
    let remaining = loan_amount;
    let number_of_payments = payments_per_year * years;

    for (var i = 0; i <= number_of_payments; i++) {
        let interest = remaining * (interest_rate / 100 / payments_per_year);
        let principle = (payment - interest);
        let row = [i, principle > 0 ? (principle < payment ? principle : payment) : 0, interest > 0 ? interest : 0, remaining > 0 ? remaining : 0];
        schedule.push(row);
        remaining -= principle
    }

    return schedule;
}