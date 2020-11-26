export const validateFieldString = ( (model,  minLenght = 1, modelName) =>  {
    let error = false;
    if(model === undefined) {
        return {hasError: true};
    }

    if(model == null || model == '') {
        error = true;
    }

    if(model !== null && model.lenght < minLenght) {
        error = true;
    }

    return {
        element: modelName,
        hasError: error
    }
});

export const cpfValidation = ( (c) => {
    const validate = validateFieldString(c, 18)

    if(validate.hasError) {
        return true;
    }

    if((c = c.replace(/[^\d]/g,"")).length != 11)
        return true

    if (c == "00000000000" ||
        c == "11111111111" ||
        c == "22222222222" ||
        c == "33333333333" ||
        c == "44444444444" ||
        c == "55555555555" ||
        c == "66666666666" ||
        c == "77777777777" ||
        c == "88888888888" ||
        c == "99999999999")
        return true;

    var r;
    var s = 0;
    var i;

    for (i=1; i<=9; i++)
        s = s + parseInt(c[i-1]) * (11 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
        r = 0;

    if (r != parseInt(c[9]))
        return true;

    s = 0;

    for (i = 1; i <= 10; i++)
        s = s + parseInt(c[i-1]) * (12 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
        r = 0;

    if (r != parseInt(c[10]))
        return true;

    return false;
});

export const isValidDate = ( (dateString) =>  {
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    var parts = dateString.split("/");
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[2], 10);

    var currentYear = new Date().getFullYear();
    if(year < 1000 || year >= currentYear || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    return day > 0 && day <= monthLength[month - 1];
});

export const validateEmail = ( (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
})
