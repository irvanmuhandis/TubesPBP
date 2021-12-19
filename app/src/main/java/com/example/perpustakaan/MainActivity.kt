package com.example.perpustakaan

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.ArrayAdapter
import android.widget.ListView
import android.widget.Toast
import androidx.recyclerview.widget.LinearLayoutManager
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        var list = ArrayList<item>()
        var url :String = "http://192.168.56.1/mini_projek/miniproject2/web_servis/get_buku.php"
        var rq: RequestQueue = Volley.newRequestQueue(this)
        var jar = JsonArrayRequest(Request.Method.GET,url,null, Response.Listener { response ->
            for (x in 0 until response.length()-1){
                list.add(item(response.getJSONObject(x).getString("judul"),
                    response.getJSONObject(x).getInt("stok_tersedia"),response.getJSONObject(x).getString("file_gambar")))
                var adp = ItemAdapter(this,list)
                rv_item.layoutManager  = LinearLayoutManager(this)
                rv_item.adapter=adp
            }
        }, Response.ErrorListener { error ->
            Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
        })
        rq.add(jar)
    }
}