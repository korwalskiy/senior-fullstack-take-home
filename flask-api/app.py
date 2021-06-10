from flask import Flask, request, Blueprint
from lib.interview_soap_client import InterviewSoapClient

app = Flask(__name__)
app_api = Blueprint('api_prefix', __name__)

@app_api.get("/")
def index():
    return "Congratulations, lets get started!"

@app_api.get("/soap")
def soap():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='helloFromPHP',
    )

    return res

@app_api.post("/webhook")
def webhook():
    payload  = request.get_json()
    print(payload['issue']['body'], flush=True)
    return "Service request POSTed"

##
# COMPANY CRUD ROUTES
##
@app_api.get("/companies")
def companies():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getAllCompanies'
    )

    return res

@app_api.get("/company/<int:id>")
def companyGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyById',
        args={'id': id}
    )

    return res

@app_api.delete("/company/<int:id>/delete")
def companyDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='deleteCompanyById',
        args={'id': id}
    )

    return res

@app_api.post("/company")
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
@app_api.get("/servicecategories")
def categories():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='getAll'
    )

    return res

@app_api.get("/servicecategory/<int:id>")
def categoryGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='getCategoryById',
        args={'id': id}
    )

    return res

@app_api.delete("/servicecategory/<int:id>/delete")
def categoryDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServiceCategoryService',
        action='deleteCategoryById',
        args={'id': id}
    )

    return res

@app_api.post("/servicecategory")
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
@app_api.get("/services")
def services():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='getAll'
    )

    return res

@app_api.get("/service/<int:id>")
def serviceGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='getServiceById',
        args={'id': id}
    )

    return res

@app_api.delete("/service/<int:id>/delete")
def serviceDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='deleteServiceById',
        args={'id': id}
    )

    return res

@app_api.post("/service")
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
# COMPANY - SERVICES RD ROUTES
##
@app_api.get("/company/<int:id>/services")
def companyServices(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getAllCompanyServices',
        args={'company_id': id}
    )

    return res

@app_api.get("/company/<int:id>/service/<int:service_id>")
def companyServiceGet(id, service_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyServiceById',
        args={'company_id': id, 'service_id': service_id}
    )

    return res

@app_api.delete("/company/<int:id>/service/delete")
def companyServiceDelete(id):
    soap_client = InterviewSoapClient()

    service_id = request.form.get('service_id')

    res = soap_client.call(
        service='CompanyService',
        action='deleteCompanyServiceById',
        args={'company_id': id, 'service_id': service_id}
    )

    return res

##
# EMPLOYEE CRUD ROUTES
##
@app_api.get("/employees")
def employees():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='EmployeeService',
        action='getAll'
    )

    return res

@app_api.get("/employee/<int:id>")
def employeeGet(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='EmployeeService',
        action='getEmployeeById',
        args={'id': id}
    )

    return res

@app_api.delete("/employee/<int:id>/delete")
def employeeDelete(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='EmployeeService',
        action='deleteEmployeeById',
        args={'id': id}
    )

    return res

@app_api.post("/employee")
def employeeSave():
    soap_client = InterviewSoapClient()

    id = request.form.get('id')
    first_name = request.form.get('first_name')
    last_name = request.form.get('last_name')
    email = request.form.get('email')
    avatar_url = request.form.get('avatar_url')
    role = request.form.get('role')
    hourly_rate = request.form.get('hourly_rate')
    company_id = request.form.get('company_id')

    res = soap_client.call(
        service='EmployeeService',
        action='saveEmployee',
        args={'id': id, 'first_name': first_name, 'last_name': last_name ,'email': email, 'avatar_url': avatar_url, 'role': role, 'company_id': company_id, 'hourly_rate': hourly_rate}
    )

    return res

##
# COMPANY - EMPLOYEE RD ROUTES
##
@app_api.get("/company/<int:id>/employees")
def companyEmployees(id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyEmployees',
        args={'company_id': id}
    )

    return res

@app_api.get("/company/<int:id>/employee/<int:employee_id>")
def companyEmployeeGet(id, employee_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyEmployeeById',
        args={'company_id': id, 'employee_id': employee_id}
    )

    return res

@app_api.delete("/company/<int:id>/employee/delete")
def companyEmployeeDelete(id):
    soap_client = InterviewSoapClient()

    employee_id = request.form.get('employee_id')

    res = soap_client.call(
        service='CompanyService',
        action='deleteCompanyEmployeeById',
        args={'company_id': id, 'employee_id': employee_id}
    )

    return res

##
# SERVICE - RATE CRU ROUTES
##
@app_api.get("/service/<int:service_id>/rate")
def serviceRateGet(service_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='ServicesService',
        action='getServiceRate',
        args={'service_id': service_id}
    )

    return res

@app_api.post("/service/<int:service_id>/rate")
def serviceRatePost(service_id):
    soap_client = InterviewSoapClient()

    id = request.form.get('id')
    unit = request.form.get('unit')
    amount = request.form.get('amount')
    duration = request.form.get('duration')
    supply_markup = request.form.get('supply_markup')
    overhead_markup = request.form.get('overhead_markup')
    misc_markup = request.form.get('misc_markup')

    res = soap_client.call(
        service='ServicesService',
        action='saveServiceRate',
        args={'service_id': service_id, 'id': id, 'unit': unit, 'duration': duration, 'amount': amount, 'supply_markup': supply_markup, 'overhead_markup': overhead_markup, 'misc_markup': misc_markup}
    )

    return res

##
# COMPABY - SERVICE - RATE GET ROUTES
##
@app_api.get("/company/<int:company_id>/service/<int:service_id>/rate")
def companyServiceRateGet(company_id, service_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyServiceRate',
        args={'company_id': company_id, 'service_id': service_id}
    )

    return res


app.register_blueprint(app_api, url_prefix='/api')
