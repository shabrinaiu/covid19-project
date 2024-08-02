# Visualizing Influence of Public Response for Accretion of COVID-19 Case in Indonesia Using Epidemic Model

## Authors
- Nana Ramadijanti
- Muarifin
- Achmad Basuki
- Urfiyatul Erifani
- Satriyo Aji
- Ulima Inas

## Outline
1. [Background](#background)
2. [Purpose](#purpose)
3. [Proposed Methods](#proposed-methods)
4. [Results](#results)
5. [Conclusion](#conclusion)

## Background
Coronavirus Disease or COVID-19 is a new disease caused by Severe Acute Respiratory Syndrome Coronavirus 2 (SARS-CoV-2). This virus can induce respiratory system disorders, ranging from mild symptoms to lung infections. The outbreak was first identified in Wuhan, China, in December 2019, with most early cases being reported in the city. After that, COVID-19 spread between humans very quickly and reached many countries, including Indonesia, in just a few months. The outbreak of COVID-19 has been declared a pandemic by the World Health Organization as of March 12, 2020. The number of COVID-19 cases is influenced by public response as one critical parameter.

## Purpose
This research aims to determine the appropriate value of β parameters from public responses with input about government policies and community actions that can affect the spread of COVID-19 in Indonesia. With the SEIR Epidemic model, we aim to predict the number of COVID-19 cases in Indonesia accurately. This will present data that is useful for the government to determine policies in all sectors moving forward. This research will predict the rise and fall in the number of COVID-19 cases in Indonesia and provide information about the number of cases at certain times, which is not limited to the present or past but also includes future projections.

## Proposed Methods
![SEIR Epidemic Model](SEIR%20Epidemic%20Model.png)
The proposed scheme of the SEIR epidemic model includes:
- The β value: indicates the spread size of COVID-19.
- The γ value: shows the cure ratio representing temporary resilience.
- Implementation of the SIR model with a public response parameter that influences the spreading of the epidemic.
- The parameter β is determined by collecting news related to public response on COVID-19 to ensure the model aligns with changes in people's behavior.

### SIR Model Parameters:
- **S<sub>t</sub>**: Number of susceptible individuals at time t.
- **I<sub>t</sub>**: Number of infectious individuals at time t.
- **R<sub>t</sub>**: Number of recovered/deceased/immune individuals at time t.

### System Design:
![System Design](System%20Design.png)
1. API Data for COVID-19
2. Database
3. Public Responses
4. SIR Epidemic Model
5. Website for COVID-19 Prediction
6. Data Visualization
7. Update β Parameter Value

### Analysis
We must re-research the factors affecting the cure ratio to enhance temporary resistance. The smaller the value of the β and γ parameters, the more sloped the graph. From two experiments, using β value of 0.285714 and γ value of 0.7470, the results show that the prediction is still not close to the factual data due to static parameter β and insufficient public responses.

## Conclusion
The community’s response using two parameters, namely β0 (0.285714) and γ (0.7470) from the Community Health Development Index (IPKM) in Indonesia. The visualization simulation results with the real data in one week, including the community’s response, can predict whether the number of cases in this pandemic will increase, remain constant, or decrease. However, the prediction results are still not close to the factual data.
