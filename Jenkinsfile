pipeline {
    agent any
    environment {
        lineApi = "https://notify-api.line.me/api/notify"
    }

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
                bat "curl -X POST -H \"Authorization: Bearer ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk\" -F \"message=helloworld\" ${lineApi}"
            }
        }
    }
}