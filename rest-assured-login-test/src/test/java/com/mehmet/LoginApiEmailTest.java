package com.mehmet;

import io.restassured.response.Response;
import org.junit.Test;

import static io.restassured.RestAssured.*;
import static org.hamcrest.Matchers.*;

public class LoginApiEmailTest {

    @Test
    public void dogruEmailVeSifreIleGiris() {
        long baslangic = System.currentTimeMillis();

        Response yanit = given()
                .contentType("application/json")
                .body("{\"email\": \"test@example.com\", \"password\": \"12345678\"}")
        .when()
                .post("http://localhost:8000/api/login")
        .then()
                .statusCode(200)
                .body("durum", equalTo("basarili"))
                .body("mesaj", containsString("Giriş"))
                .extract().response();

        long sure = System.currentTimeMillis() - baslangic;
        assert sure < 1000 : "Yanıt çok yavaş geldi: " + sure + " ms";
    }

    @Test
    public void yanlisSifreIleGiris() {
        given()
            .contentType("application/json")
            .body("{\"email\": \"test@example.com\", \"password\": \"yanlisSifre\"}")
        .when()
            .post("http://localhost:8000/api/login")
        .then()
            .statusCode(401)
            .body("durum", equalTo("hata"))
            .body("mesaj", containsString("hatalı"));
    }
}