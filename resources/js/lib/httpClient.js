const httpClient = (url, method = "GET", body = {}, headers = {}) => {
    return fetch(url, {
        method,
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            ...headers,
        },
        ...(["POST", "PUT", "PATCH", "UPDATE"].includes(method) && {
            body: JSON.stringify(body),
        }),
    });
};

export default httpClient;
