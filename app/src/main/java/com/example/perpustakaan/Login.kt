package com.example.perpustakaan

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.TextUtils
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.wajahatkarim3.easyvalidation.core.view_ktx.nonEmpty
import com.wajahatkarim3.easyvalidation.core.view_ktx.textEqualTo

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

                    if(pwd.nonEmpty()&& name.nonEmpty()){

                        var url =
                        "https://perpustakaan.freehost.id/web_servis/login_mobile.php?nama=" + name.text.trim()
                            .toString() + "&pwd=" + pwd.text.trim().toString()
                    var rq: RequestQueue = Volley.newRequestQueue(this)
                    var sr = StringRequest(Request.Method.GET, url, Response.Listener { response ->

                        if (response.equals("1")) {
                            UserInfo.nama = name.text.toString()
                            var o = Intent(this, MainActivity::class.java)
                            startActivity(o)
                        } else {
                            Toast.makeText(this, "Username atau Password salah ", Toast.LENGTH_LONG).show()
                        }
                    }, Response.ErrorListener { error ->
                        Toast.makeText(this, error.message, Toast.LENGTH_LONG).show()
                    })
                    rq.add(sr)
                }
                    else{
                        Toast.makeText(this,"ISI NAMA DAN PASSOWORD !!",Toast.LENGTH_LONG).show()
                    }
                }

    }
}