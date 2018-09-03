#!groovy
pipeline {
    agent any

    stages {
        stage ('Compile Stage') {
            steps {
                echo 'Compile Stage'

            }
        }

        stage ('Testing Stage') {
            steps {
                echo 'Testing Stage'
            }
        }

        stage ('Deployment Stage') {
            steps {
                echo 'Deployment Stage'
            }
        }
        stage ('Notify'){
            steps {
                notifyLINE('ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk','SUCCESS')
                //bat "curl -X POST -H \"Authorization: Bearer ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk\" -F \"message=helloworld\" ${lineApi}"
            }
        }
    }
}

def notifyLINE(token, result) {
    def isFailure = result == 'FAILURE'
      
    def url = 'https://notify-api.line.me/api/notify'
    def message = "Build Master, result is ${result}."
    //def imageThumbnail = isFailure ? 'FAILED_IMAGE_THUMBNAIL' : ''
    //def imageFullsize = isFailure ? 'FAILED_IMAGE_FULLSIZE' : ''
      
    bat "curl -X POST -H \"Authorization: Bearer ${token}\" -F \"message=${message}\" ${url}"
}