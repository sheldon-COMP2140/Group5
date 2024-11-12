import java.util.Scanner;

public class Mileage {
    /** Testing 1, 2, 3 */
    public static void main(String[] args) {
        int miles;
        double gallons, mpg;

        // Scanner for user input
        Scanner s = new Scanner(System.in);

        // Input
        System.out.println("Enter miles and gallons: ");
        miles = s.nextInt();
        gallons = s.nextDouble();

        // Calculating miles per gallon (mpg)
        mpg = miles / gallons;

        // Output
        System.out.println("Miles per Gallon: " + mpg);

        // Closing the scanner
        s.close();
    }
}