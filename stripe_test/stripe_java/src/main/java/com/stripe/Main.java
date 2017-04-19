package com.stripe;

import java.util.HashMap;
import java.util.Map;

import com.stripe.Stripe;
import com.stripe.model.Charge;
import com.stripe.model.Customer;


public class Main {

	
	public static final String API_KEY = "sk_test_mOnLXjlJxHHd48z5pIKOaJxO";
	public static String token = "tok_1A7TVqFjX0PMgDEU0mZkv20g";
	
    public static void main(String[] args) throws Exception
    {

//    	String customerID = createCustomer();
//    	chargeCustomer(customerID);
    	chargeCustomer("cus_ASOIdyUn2nuO0X");
    }
    
    public static String createCustomer() throws Exception
    {
    	// Set your secret key: remember to change this to your live secret key in production
    	// See your keys here: https://dashboard.stripe.com/account/apikeys
    	Stripe.apiKey = API_KEY;

    	// Token is created using Stripe.js or Checkout!
    	// Get the payment token submitted by the form:


    	// Create a Customer:
    	Map<String, Object> customerParams = new HashMap<String, Object>();
    	customerParams.put("email", "paying.user@example.com");
    	customerParams.put("source", token);
    	Customer customer = Customer.create(customerParams);

    	String customerID = customer.getId();
    	System.out.println("Customer ID: " + customerID);
    	return customerID; 

    }
    
    
    public static void chargeCustomer(String customerID) throws Exception
    {
    	Stripe.apiKey = API_KEY;
    	
    	Map<String, Object> chargeParams = new HashMap<String, Object>();
    	chargeParams.put("amount", 2500); 
    	chargeParams.put("currency", "usd");
    	chargeParams.put("customer", customerID);
    	Charge charge = Charge.create(chargeParams);
    }
    
}