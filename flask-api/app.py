from flask import Flask, request
from lib.interview_soap_client import InterviewSoapClient

app = Flask(__name__)


@app.get("/")
def index():
    return "Congratulations, lets get started!"

@app.get("/soap")
def soap():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='helloFromPHP',
    )

    return res

##
# COMPANY CRUD ROUTES
##
@app.get("/companies")
def companies():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getAllCompanies'
    )

    return res

@app.get("/company/<int:id>")
def companyGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyById',
        args={'id': id}
    )

    return res

@app.delete("/company/<int:id>/delete")
def companyDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='deleteCompanyById',
        args={'id': id}
    )

    return res

@app.post("/company")
def companySave():
    soap_client = InterviewSoapClient()

    id = request.form.get('id')
    name = request.form.get('name')
    email = request.form.get('email')
    logo_url = request.form.get('logo_url')
    address = request.form.get('address')
    country = request.form.get('country')
    tax_rate = request.form.get('tax_rate')

    res = soap_client.call(
        service='CompanyService',
        action='saveCompany',
        args={'id': id, 'name': name, 'email': email, 'logo_url': logo_url, 'address': address, 'country': country, 'tax_rate': tax_rate}
    )

    return res

##
# SERVICE CATEGORY CRUD ROUTES
##
@app.get("/servicecategories")
def categories():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='getAll'
    )

    return res

@app.get("/servicecategory/<int:id>")
def categoryGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='getCategoryById',
        args={'id': id}
    )

    return res

@app.delete("/servicecategory/<int:id>/delete")
def categoryDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='deleteCategoryById',
        args={'id': id}
    )

    return res

@app.post("/servicecategory")
def categorySave():
    soap_client = InterviewSoapClient()

    id = request.form.get('id')
    name = request.form.get('name')

    res = soap_client.call(
        service='ServiceCategoryService',
        action='saveCategory',
        args={'id': id, 'name': name}
    )

    return res

##
# SERVICE CRUD ROUTES
##
@app.get("/services")
def services():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='getAll'
    )

    return res

@app.get("/service/<int:id>")
def serviceGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='getServiceById',
        args={'id': id}
    )

    return res

@app.delete("/service/<int:id>/delete")
def serviceDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='deleteServiceById',
        args={'id': id}
    )

    return res

@app.post("/service")
def serviceSave():
    soap_client = InterviewSoapClient()

    id = request.form.get('id')
    name = request.form.get('name')
    company_id = request.form.get('company_id')
    service_category_id = request.form.get('service_category_id')

    res = soap_client.call(
        service='ServicesService',
        action='saveService',
        args={'id': id, 'name': name, 'company_id': company_id, 'service_category_id': service_category_id}
    )

    return res

##
# COMPANY - SERVICES CRUD ROUTES
##
@app.get("/company/<int:id>/services")
def companyServices(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getAllCompanyServices',
        args={'company_id': id}
    )

    return res

@app.get("/company/<int:id>/service/<int:service_id>")
def companyServiceGet(id, service_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyServiceById',
        args={'company_id': id, 'service_id': service_id}
    )

    return res

@app.delete("/company/<int:id>/service/delete")
def companyServiceDelete(id):
    soap_client = InterviewSoapClient()

    service_id = request.form.get('service_id')

    res = soap_client.call(
        service='CompanyService',
        action='deleteCompanyServiceById',
        args={'company_id': id, 'service_id': service_id}
    )

    return res

