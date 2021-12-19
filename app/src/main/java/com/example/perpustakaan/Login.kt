package com.example.perpustakaan

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley

class Login : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login2)

        val signup : Button = findViewById(R.id.signup)
        signup.setOnClickListener{
            val i = Intent(this,Regis::class.java)
            startActivity(i)
        }
        val pwd : EditText = findViewById(R.id.pwd)
        val name: EditText =findViewById(R.id.username)
        val login: Button = findViewById(R.id.login)
        login.setOnClickListener {
            var url = "http://192.168.56.1/mini_projek/miniproject2/web_servis/login_mobile.php?nama="+name.text.toString()+"&pwd="+pwd.text.toString()
            var rq : RequestQueue = Volley.newRequestQueue(this)
            var sr =  StringRequest(Request.Method.GET,url, Response.Listener { response ->
                if(response.equals("0")){
                    Toast.makeText(this,"Username atau Password salah ", Toast.LENGTH_LONG).show()
                }
                else{
                    UserInfo.nama = name.text.toString()
                    var o = Intent(this,MainActivity::class.java)
                    startActivity(o)
                }

            }, Response.ErrorListener { error ->
                Toast.makeText(this,error.message, Toast.LENGTH_LONG).show()
            })
            rq.add(sr)

        }
    }
}