from flask import Flask, render_template,url_for,redirect,request
from flaskext.mysql import MySQL
app = Flask(__name__)

mysql=MySQL()

app.config["MYSQL_DATABASE_USER"]='root'
app.config["MYSQL_DATABASE_PASSWORD"]=''
app.config["MYSQL_DATABASE_DB"]='ecom_db'
app.config["MYSQL_DATABASE_HOST"]='localhost'
mysql.init_app(app)


@app.route("/")
def home():
    return render_template("index.html")


@app.route("/index",methods=['GET','POST'])
def index():
        con=mysql.connect()  
        cur1=con.cursor()
        cur1.execute("SELECT * FROM `products`")
        data=cur1.fetchall()
        delid=request.args.get('img_name')
        return render_template("index.html",pro=data)

################################################# BAD ####################################################
# @app.route("/login",methods=['GET','POST'])
# def login():
#     if request.method=='POST':
#         username=request.form['username']
#         password=request.form['password']
#         con=mysql.connect()
#         cur=con.cursor()
#         cur.execute("SELECT * FROM `users` WHERE `username` = '"+username+"' and `password` = '"+password+"'")           
#         if cur.fetchone():
#             return redirect(url_for('index'))
#         else:
#             return "<script>alert('ERROR')</script>"        
     
#     else:   
#         return render_template("login.html")



# @app.route("/comment",methods=['GET','POST'])
# def comment():
#     if request.method=='GET':  
#         con=mysql.connect()  
#         cur1=con.cursor()
#         cur1.execute("SELECT * FROM `comments`")
#         data=cur1.fetchall()
#         return render_template("comment.html",dis=data)
    
#     else :
#         name=request.form['name']
#         message=request.form['message']
#         con=mysql.connect()
#         cur=con.cursor()
#         cur.execute("INSERT INTO `comments`(`name`,`message`) VALUES (%s,%s)",(name,message))
#         con.commit()

################################################################################################


############################################### SAFE ################################################
@app.route("/login",methods=['GET','POST'])
def login():
    if request.method=='POST':
        username=request.form['username']
        password=request.form['password']
        con=mysql.connect()
        cur=con.cursor()
        cmd = ("SELECT * FROM `users` WHERE `username` = %s and `password` = %s")
        cur.execute(cmd, (username,password))
        data=cur.fetchone()                      
        if data is None:
            return "ERROR" 
        elif data[1]==username and data[3]==password:
            return redirect(url_for('index',data=data[0])) 
        else:
            return render_template("login.html")
        
    else:   
        return render_template("login.html")



@app.route("/comment",methods=['GET','POST'])
def comment():
    if request.method=='GET':  
        con=mysql.connect()  
        cur1=con.cursor()
        cur1.execute("SELECT * FROM `comments`")
        data=cur1.fetchall()
        return render_template("comment.html",dis=data)
    
    else :
        name=request.form['name']
        message=request.form['message']
        con=mysql.connect()
        cur=con.cursor()
        cur.execute("""INSERT INTO `comments`(`name`,`message`) VALUES(?,?)""", (name1,mes1))
        con.commit()
        return redirect(url_for('comment'))

#######################################################################################################

@app.route("/delete")
def delete():
    con=mysql.connect()
    cur=con.cursor()
    delid=request.args.get('id')
    cur.execute("DELETE FROM `comments` WHERE id='"+delid+"'")
    con.commit()
    return redirect(url_for('comment')) 



if(__name__ == '__main__'):
    app.run(debug=True)