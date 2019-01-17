swagger: '2.0'
info:
  version: 1.0.0
  title: oms APIs
  description: |
    ####  https://<?php echo $_SERVER['SERVER_NAME']; ?>/api
    Use Above URL as basepath + path listed below and use Try Operation to test it. You can see the response right here.
    
definitions: 
   Error:
    type: object
    properties:
      status:
        type: boolean
      message:
        type: string
      errors:
        type: object
        description: Key/value errors for each field
        
schemes:
  - http
host:   <?php echo $_SERVER['SERVER_NAME']."/omsinfo/public"; ?>

basePath: /api
paths:
  /user/registration:
    post:
      description: Used to register as admin 
      responses:
        200:
          description: Success response
        
      parameters:
      
        - name: name
          required: true
          in: formData
          description: User's name
          type: string    
        - name: email
          required: true
          in: formData
          description: User's Email
          type: string
        - name: mobile
          required: true
          in: formData
          description: Mobile no
          type: integer  
        - name: password
          required: true
          in: formData
          description: User's password
          type: string
        - name: aadhar
          required: true
          in: formData
          description: Aadhar no
          type: integer
        - name: address
          required: true
          in: formData
          description: Address 
          type: string
        - name: companyName
          required: false
          in: formData
          description: Company no
          type: string
        - name: fax
          required: false
          in: formData
          description: Fax no 
          type: string
        - name: companyAddress
          required: false
          in: formData
          description: Company Address
          type: string
        - name: registrationNo
          required: false
          in: formData
          description: Company Registration no 
          type: string    
        - name: deviceToken
          required: false
          in: formData
          description: Device token
          type: string  
        - name: deviceType
          required: true
          in: formData
          description: Device Type user is signing up with | 1 => 'ios' | 2 => 'android'
          type: integer
  /user/login:
    post:
      description: Used for user login
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
          
        - name: email
          required: true
          in: formData
          description: User's Email / phone number
          type: string  
        - name: password
          required: true
          in: formData
          description: User's password
          type: string
        - name: deviceToken
          required: false
          in: formData
          description: Device token
          type: string  
        - name: deviceType
          required: true
          in: formData
          description: Device Type user is signing up with | 1 => 'ios' | 2 => 'android'
          type: integer    
  
  /user/userLogout:
    get:
      description: Used to logout user from app
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
        - name: userToken
          required: true
          in: header
          description: User access token 
          type: string
        - name: deviceType
          required: true
          in: header
          description: Device Type, 1 for iOS
          type: string
          

  /user/setupProfile:
    post:
      description: Used to setup profile
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
        - name: userToken
          required: true
          in: header
          description: User access token 
          type: string
        - name: deviceType
          required: true
          in: header
          description: Device Type, 1 for iOS and 2 for android
          type: string
        - name: email
          required: false
          in: formData
          description: User email address
          type: string
        - name: stateName
          required: false
          in: formData
          description: User's state
          type: string
        - name: countryName
          required: false
          in: formData
          description: User's country
          type: string
        - name: gender
          required: false
          in: formData
          description: gender 1 for male 2 for female 
          type: integer
        - name: dateOfBirth
          required: false
          in: formData
          description: date Of Birth format Y-m-d
          type: string
        - name: relationShipStatus
          required: false
          in: formData
          description: relationship status 1 for single 2 for 
          type: string
        - name: like
          required: false
          in: formData
          description: Like of the user
          type: string
        - name: disLike
          required: false
          in: formData
          description: Dislike of the user
          type: string  
        - name: userBio
          required: false
          in: formData
          description: Short description of your bio
          type: string
        - name: avatar_name
          required: false
          in: formData
          description: Name of Avatar
          type: string
  
  /user/getProfile:
    post:
      description: Used to get user profile
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
        - name: userToken
          required: true
          in: header
          description: User access token 
          type: string
        - name: deviceType
          required: true
          in: header
          description: Device Type, 1 for iOS and 2 for android
          type: string
        - name: userId
          required: false
          in: formData
          description: User id for detail
          type: string

  /user/updateDeviceToken:
    post:
      description: Used to update device token on click setting button
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
        - name: userToken
          required: true
          in: header
          description: User access token 
          type: string
        - name: deviceType
          required: true
          in: header
          description: Device Type, 1 for iOS
          type: string
        - name: deviceToken
          required: false
          in: formData
          description: Device token
          type: string
  
  /user/changePassword:
    post:
      description: Used to change password
      responses:
        200:
          description: Success response
        default:
          description: Unexpected error
          schema:
             $ref: '#/definitions/Error'
      parameters:
        - name: userToken
          required: true
          in: header
          description: User access token 
          type: string
        - name: deviceType
          required: true
          in: header
          description: Device Type, 1 for iOS and 2 for android
          type: string
        - name: oldPassword
          required: true
          in: formData
          description: Old password
          type: string
        - name: password
          required: true
          in: formData
          description: New Password
          type: string  