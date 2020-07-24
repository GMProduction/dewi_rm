const fetchData = function (url, params = {}) {
    return $.get(url, Object.assign({}, params));
};

const lazyElement = function (selector = '') {
    let el = $(selector);
    let products = [];
    return {
        el,
        products,
        setProducts(products = []) {
            this.products = products;
            return this;
        },
        createCard() {
            this.el.empty();
            if (this.products.length) {
                $.each(this.products, function (k, v) {
                    const {id, name, price, description, images} = v;
                    let element = '<div class="col-lg-3 col-sm-12 mb-2">' +
                        '<div class="card" style="height: 350">' +
                        '<img height="150" src="/images/uploads/' + images + '" alt="" class="card-img-top">' +
                        '<div class="card-body">' +
                        '<p class="my-card-title">' + name + '</p>' +
                        '<p class="my-card-description">' + description + '</p>' +
                        '<p class="my-card-price">' + price + '</p>' +
                        '<a class="btn my-button float-right" href="/products/' + id + '">Detail</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $(selector).append(element);
                });
            } else {
                this.el.append('<div class="text-center">' +
                    '<p>No Products Available</p>' +
                    '</div>');
            }
        }
    }
};

const lazyProcess = function (selector = '') {
    let el = $(selector);
    return {
        el,
        alert(type = 'success', message = '', duration = 1500) {
            let content = '<div class="card">' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
            let context = this;
            switch (type) {
                case "success":
                    content = '<div class="card">' +
                        '<div class="card-body">' +
                        '<div class="text-center f18 f-bold my-text-dark">Success</div>' +
                        '<div class="text-justify f14 my-text-semi-dark">' + message + '</div>' +
                        '</div>' +
                        '</div>';
                    break;
                case "error":
                    content = '<div class="card">' +
                        '<div class="card-body">' +
                        '<div class="text-center f18 f-bold my-text-dark">Error</div>' +
                        '<div class="text-justify f14 my-text-semi-dark">' + message + '</div>' +
                        '</div>' +
                        '</div>';
                    break;
                default:
                    break;
            }
            this.el.css('display', 'flex');
            this.el.empty();
            this.el.append(content)
            setTimeout(function () {
                context.dispose();
            }, duration);
        },
        showLoading(text = 'Please Wait....') {
            this.el.css('display', 'flex');
            this.el.empty();
            let content = '<div class="text-center">' +
                '<div class="text-center spinner-border text-light" role="status">\n' +
                '<span class="sr-only">Loading...</span>\n' +
                '</div>' +
                '<div class="text-center text-light">' + text + '</div>' +
                '</div>';
            this.el.append(content)
        },
        dispose() {
            this.el.css('display', 'none');
            this.el.empty();
        }
    }
};

